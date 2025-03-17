<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        "plan_name",
        "image",
        "type",
        "regular_price",
        "offer_price",
        "duration_days",
        "status",
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

}
