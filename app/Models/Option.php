<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasTranslations;
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
    public function getNameAttribute()
    {
        return $this->getTranslation('name');
    }public function getTitleAttribute()
    {
        return $this->getTranslation('title');
    }

    public function getSubTitleAttribute()
    {
        return $this->getTranslation('sub_title');
    }

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

    public function patches()
    {
        return $this->belongsToMany(Patch::class, 'option_patches');
    }

    public function staticResult()
    {
        return $this->hasOne(OptionStaticResult::class, 'option_id');
    }

}
