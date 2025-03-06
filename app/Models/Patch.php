<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patch extends Model
{
    protected $fillable = [
        "design_type_id",
        "code",
        "title",
        "content_type",
        "order",
        "status",
    ];

    public function designType()
    {
        return $this->belongsTo(DesignType::class);
    }
    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_patches');
    }

}
