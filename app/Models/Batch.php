<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'company_id',
        'breed_id',
        'category_id',
        'batch_number',
        'quantity',
        'arrival_date',
        'initial_weight',
        'cost_per_chick',
        'source_supplier',
        'shed_number',
        'status',
        'expected_finish_date',
        'actual_finish_date',
        'notes',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class, 'breed_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
