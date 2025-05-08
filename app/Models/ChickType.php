<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class ChickType extends Model
{
    use HasTranslations;
    protected $fillable = [
        'name',
    ];

    public function companyAndChicks()
    {
        return $this->hasMany(CompanyAndChick::class);
    }
    public function getNameAttribute()
    {
        return $this->getTranslation('name');
    }
}
