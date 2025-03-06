<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChickType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function companyAndChicks()
    {
        return $this->hasMany(CompanyAndChick::class);
    }
}
