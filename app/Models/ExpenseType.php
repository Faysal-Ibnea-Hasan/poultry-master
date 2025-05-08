<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasTranslations;
    protected $fillable = [
        'name',
        'type'
    ];
    public function getNameAttribute()
    {
        return $this->getTranslation('name');
    }
}
