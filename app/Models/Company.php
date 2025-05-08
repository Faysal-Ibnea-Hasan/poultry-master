<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasTranslations;
    protected $fillable = [
        'name',
        'address',
        'contact_person',
        'phone',
        'email',
        'logo',
        'registration_number',
    ];
    public function getNameAttribute()
    {
        return $this->getTranslation('name');
    }
}
