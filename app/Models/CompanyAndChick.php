<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAndChick extends Model
{
    protected $fillable = [
        "option_id",
        "company_id",
        "breed_id",
        "chick_type_id"
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function chickType()
    {
        return $this->belongsTo(ChickType::class);
    }
}
