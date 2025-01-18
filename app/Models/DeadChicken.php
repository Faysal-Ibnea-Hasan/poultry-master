<?php

namespace App\Models;

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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
