<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DeadChicken extends Model
{
    protected $fillable = [
        'company_id',
        'batch_id',
        'date',
        'quantity',
        'reason',
        'weight',
        'disposal_method',
        'notes',
    ];
    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function setDateAttribute($value)
    {
        try {
            $this->attributes['date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        } catch (\Exception $exception) {
            $this->attributes['date'] = null;
        }
    }

    public function getDateAttribute($value)
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
}
