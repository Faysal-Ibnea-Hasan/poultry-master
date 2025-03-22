<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Batch extends Model
{
    protected $fillable = [
        'batch_number',
        'created_by',
        'chick_type_id',
        'company_name',
        'quantity',
        'cost_per_chick',
        'arrival_date',
        'initial_weight',
        'source_supplier',
        'shed_number',
        'status',
        'expected_finish_date',
        'actual_finish_date',
        'notes',
    ];

    protected $casts = [
        'arrival_date' => 'date:Y-m-d',
    ];

    public function setArrivalDateAttribute($value)
    {
        try {
            $this->attributes['arrival_date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            $this->attributes['arrival_date'] = null; // Set to null if invalid
        }
    }

    public function getArrivalDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function chickType()
    {
        return $this->belongsTo(ChickType::class, 'chick_type_id');
    }

    public function deadChickens()
    {
        return $this->hasMany(DeadChicken::class, 'batch_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function sells()
    {
        return $this->hasMany(Sell::class);
    }
}
