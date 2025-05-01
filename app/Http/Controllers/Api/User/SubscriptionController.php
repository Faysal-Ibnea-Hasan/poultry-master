<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\Subscriber;
use App\Models\Subscription;
use App\Services\BkashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function __construct(protected BkashService $bkash)
    {

    }

    public function subscribe(Request $request, BkashService $bkash)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
            ]);
        }

        $subscription = Subscription::find($request->subscription_id);
        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription not found',
            ]);
        }
        $invoice = 'SUB' . time();
        $paymentResponse = $bkash->createPayment($subscription->offer_price, $invoice);
        if (isset($paymentResponse['bkashURL'])) {
            PaymentTransaction::create([
                'subscription_id' => $subscription->id,
                'subscriber_id' => auth('sanctum')->id(),
                'payment_id' => $paymentResponse['paymentID'],
                'amount' => $paymentResponse['amount'],
                'intent' => $paymentResponse['intent'],
                'currency' => $paymentResponse['currency'],
                'invoice' => $paymentResponse['merchantInvoiceNumber'],
                'status' => $paymentResponse['transactionStatus'],
                'payment_time' => $paymentResponse['paymentCreateTime'],
                'status_code' => $paymentResponse['statusCode'],
                'status_message' => $paymentResponse['statusMessage'],
            ]);
            return response()->json([
                'message' => 'Redirect user to bKash payment page',
                'bkashURL' => $paymentResponse,
            ]);
        }

        return response()->json(['message' => 'Payment initiation failed'], 400);
    }

    public function paymentSuccess(Request $request, BkashService $bkash)
    {
        $payment = $bkash->executePayment($request->paymentID);
        if ($payment['transactionStatus'] === 'Completed') {
            // Update Payment Transaction
            $paymentTransaction = PaymentTransaction::where('payment_id', $payment['paymentID'])->first();
            if (!$paymentTransaction) {
                return response()->json(['message' => 'Transaction not found!', 'data' => [], 404]);
            }
            $existing = Subscriber::where('user_id', $paymentTransaction->subscriber_id)
                ->where('subscription_id', $paymentTransaction->subscription_id)
                ->first();

            $duration = $paymentTransaction->subscription->duration_days ?? 7;

            if ($existing) {
                // Calculate remaining time from now to existing end_date (if future)
                $now = now();
                $remainingDays = $existing->end_date->gt($now)
                    ? $existing->end_date->diffInDays($now)
                    : 0;

                $newEndDate = $now->addDays($duration + $remainingDays);

                $existing->update([
                    'payment_status' => 'paid',
                    'is_active' => 1,
                    'end_date' => $newEndDate,
                ]);

                $subscriber = $existing;
            } else {
                $subscriber = Subscriber::create([
                    'user_id' => $paymentTransaction->subscriber_id,
                    'subscription_id' => $paymentTransaction->subscription_id,
                    'start_date' => now(),
                    'end_date' => now()->addDays($duration),
                    'payment_status' => 'paid',
                    'is_active' => 1,
                ]);
            }

            $paymentTransaction->update([
                'trx_id' => $payment['trxID'],
                'status' => $payment['transactionStatus'],
                'payment_time' => $payment['paymentExecuteTime'],
                'status_code' => $payment['statusCode'],
                'status_message' => $payment['statusMessage'],
                'payer_type' => $payment['payerType'],
                'payer_reference' => $payment['payerReference'],
                'customer_msisdn' => $payment['customerMsisdn'],
                'payer_account' => $payment['payerAccount'],
                'max_refundable_amount' => $payment['maxRefundableAmount'],
            ]);

            return response()->json(['message' => 'Payment successful!', 'data' => $payment]);
        }

        return response()->json(['message' => 'Payment failed!'], 400);
    }
}
