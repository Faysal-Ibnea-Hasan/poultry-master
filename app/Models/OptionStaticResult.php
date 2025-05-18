<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class OptionStaticResult extends Model
{
    use HasTranslations;

    protected $fillable = [
        "option_id",
        "title",
        "sub_title",
        "file",
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function getTitleAttribute()
    {
        return $this->getTranslation('title');
    }

    public function getSubTitleAttribute()
    {
        return $this->getTranslation('sub_title');
    }

    public function getFileAttribute()
    {
        return $this->getTranslation('file');
    }
}
