<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VaccinationSchedule extends Model
{
    protected $fillable = [
        'batch_id',
        'disease_id',
        'category_id',
        'vaccine_name',
        'scheduled_date',
        'actual_date',
        'dosage',
        'administration_method',
        'administered_by',
        'cost',
        'notes',
    ];
    protected $casts = [
        'actual_date' => 'date',
        'scheduled_date' => 'date',
    ];

    protected function batch()
    {
        $this->belongsTo(Batch::class, 'batch_id');
    }

    protected function category()
    {
        $this->belongsTo(Category::class, 'category_id');
    }

    protected function disease()
    {
        $this->belongsTo(Disease::class, 'disease_id');
    }
}
