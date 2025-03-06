<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionPatch extends Model
{
    protected $fillable = [
        "option_id",
        "patch_id",
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function patch()
    {
        return $this->belongsTo(Patch::class);
    }
}
