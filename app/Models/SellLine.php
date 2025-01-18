<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellLine extends Model
{
    protected $fillable = [
        'sell_id',
        'product_type',
        'quantity',
        'unit_price',
        'total_weight',
        'amount',
    ];

    public function sell()
    {
        return $this->belongsTo(Sell::class, 'sell_id');
    }
}
