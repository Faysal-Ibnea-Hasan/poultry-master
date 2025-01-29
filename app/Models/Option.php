<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'name',
        'image',
        'title',
        'design_type'
    ];

    public function results()
    {
        return $this->hasMany(OptionResult::class);
    }

    public function attributes()
    {
        return $this->hasMany(OptionAttribute::class);
    }
}
