<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignType extends Model
{
    protected $fillable = [
        'type',
        'order',
        'isPro',
        'status',
    ];

    public function options()
    {
        return $this->hasMany(Option::class, 'design_type_id', 'id');
    }
}
