<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
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

        $paymentResponse = $bkash->createPayment(1, $invoice);

        if (isset($paymentResponse['bkashURL'])) {
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
        dd($payment);
        if ($payment['status'] === 'Completed') {
            // Store successful payment in database
            return response()->json(['message' => 'Payment successful!', 'data' => $payment]);
        }

        return response()->json(['message' => 'Payment failed!'], 400);
    }
}
