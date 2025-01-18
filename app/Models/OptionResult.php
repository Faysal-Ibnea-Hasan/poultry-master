<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionResult extends Model
{
    protected $fillable = [
        'option_id',
        'breed_id',
        'option_attribute_id',
        'value',
        'day'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function attribute()
    {
        return $this->belongsTo(OptionAttribute::class, 'option_attribute_id');
    }
}
