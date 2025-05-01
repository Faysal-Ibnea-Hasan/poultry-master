<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'subscription_id',
        'subscriber_id',
        'payment_id',
        'trx_id',
        'invoice',
        'status',
        'amount',
        'currency',
        'intent',
        'payment_time',
        'payer_type',
        'payer_reference',
        'customer_msisdn',
        'payer_account',
        'max_refundable_amount',
        'status_code',
        'status_message',
    ];

    public function setPaymentTimeAttribute($value)
    {
        if ($value) {
            try {
                // Clean and parse value
                $cleanTime = preg_replace('/:\d{3} GMT[+-]\d{4}$/', '', $value);
                $this->attributes['payment_time'] = Carbon::parse($cleanTime)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                $this->attributes['payment_time'] = now();
            }
        }
    }
    public function subscriber()
    {
        return $this->belongsTo(User::class, 'subscriber_id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
}
