<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasTranslations;

    protected $fillable = [
        "plan_name",
        "image",
        "type",
        "regular_price",
        "offer_price",
        "duration_days",
        "status",
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function getPlanNameAttribute()
    {
        return $this->getTranslation('plan_name');
    }

}
