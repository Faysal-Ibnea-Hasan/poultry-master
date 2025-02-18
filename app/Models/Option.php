<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'name',
        'image',
        'title',
        'status',
        'isPro',
        'order',
        'design_type_id',
        'sub_title',
        'content_type',
        'link',
        'action',
    ];

    public function results()
    {
        return $this->hasMany(OptionResult::class);
    }

    public function attributes()
    {
        return $this->hasMany(OptionAttribute::class);
    }

    public function designType()
    {
        return $this->belongsTo(DesignType::class, 'design_type_id');
    }


}
