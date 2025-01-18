<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $fillable = [
        'company_id',
        'batch_id',
        'invoice_number',
        'customer_name',
        'customer_phone',
        'customer_address',
        'sale_date',
        'total_amount',
        'discount',
        'paid_amount',
        'payment_status',
        'payment_method',
        'notes',
    ];
    protected $casts = [
        'sale_date' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
