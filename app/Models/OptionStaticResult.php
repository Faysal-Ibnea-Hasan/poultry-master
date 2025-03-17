<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionStaticResult extends Model
{
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
}
