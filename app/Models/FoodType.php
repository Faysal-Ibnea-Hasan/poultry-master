<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    use HasTranslations;

    protected $fillable = ['name'];

    public function getNameAttribute()
    {
        return $this->getTranslation('name');
    }
}
