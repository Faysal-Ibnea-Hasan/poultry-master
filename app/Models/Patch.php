<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patch extends Model
{
    protected $fillable = ['code', 'title', 'option_ids', 'order'];

    protected $casts = [
        'option_ids' => 'array', // Automatically converts JSON to an array
    ];

    public function getOptionsAttribute()
    {
        return Option::whereIn('id', $this->option_ids)->get();
    }
}
