<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionAttribute extends Model
{
    protected $fillable = ['name'];

    public function options()
    {
        return $this->hasMany(OptionResult::class, 'option_attribute_id');
    }
}
