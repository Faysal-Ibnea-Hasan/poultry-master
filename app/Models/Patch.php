<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Patch extends Model
{
    use HasTranslations;
    protected $fillable = [
        "design_type_id",
        "code",
        "title",
        "content_type",
        "order",
        "status",
    ];
    public function getTitleAttribute()
    {
        return $this->getTranslation('title');
    }
    public function designType()
    {
        return $this->belongsTo(DesignType::class);
    }
    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_patches');
    }

}
