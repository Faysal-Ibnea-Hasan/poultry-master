<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class OptionAttribute extends Model
{
    use HasTranslations;
    protected $fillable = ['name'];

    public function options()
    {
        return $this->hasMany(OptionResult::class, 'option_attribute_id');
    }
    public function getNameAttribute()
    {
        return $this->getTranslation('name');
    }
}
