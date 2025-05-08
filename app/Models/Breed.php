<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'average_life_span',
        'average_weight',
        'purpose',
        'characteristics',
    ];

    public function getNameAttribute()
    {
        return $this->getTranslation('name');
    }

    public function getDescriptionAttribute()
    {
        return $this->getTranslation('description');
    }
    public function getPurposeAttribute()
    {
        return $this->getTranslation('purpose');
    }
    public function getCharacteristicsAttribute()
    {
        return $this->getTranslation('characteristics');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
