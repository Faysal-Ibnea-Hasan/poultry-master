<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        'sale_date' => 'date:Y-m-d',
    ];
    public function setSaleDateAttribute($value)
    {
        try {
            $this->attributes['sale_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            $this->attributes['sale_date'] = null; // Set to null if invalid
        }
    }

    public function getSaleDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function sellLine()
    {
        return $this->belongsTo(SellLine::class, 'id');
    }
}
