<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    protected $fillable = [
        'name',
        'description',
        'average_life_span',
        'average_weight',
        'purpose',
        'characteristics',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
