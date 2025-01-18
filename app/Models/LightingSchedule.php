<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LightingSchedule extends Model
{
    protected $fillable = [
        'batch_id',
        'day_number',
        'light_hours',
        'light_intensity',
        'start_time',
        'end_time',
        'notes',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
