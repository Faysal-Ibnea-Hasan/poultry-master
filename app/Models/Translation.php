<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = [
        'translatable_type',
        'translatable_id',
        'key',
        'locale',
        'value',
    ];

    public function translatable()
    {
        return $this->morphTo();
    }
}
