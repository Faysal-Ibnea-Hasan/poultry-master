<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BroodingTemperature extends Model
{
    protected $fillable = [
        'batch_id',
        'day_number',
        'target_temperature',
        'actual_temperature',
        'humidity_level',
        'notes',
    ];

    protected function batch()
    {
        $this->belongsTo(Batch::class, 'batch_id');
    }
}
