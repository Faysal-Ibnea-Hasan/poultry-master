<?php

namespace App\Models;

use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Expense extends Model
{
    use HasTranslations;

    protected $fillable = [
        'company_id',
        'batch_id',
        'date',
        'expense_type',
        'amount',
        'number_of_sack',
        'cost_per_sack',
        'food_type',
        'description',
        'payment_status',
        'payment_method',
        'receipt_number',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function getNameAttribute()
    {
        return $this->getTranslation('name');
    }

    public function setDateAttribute($value)
    {
        try {
            $this->attributes['date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            $this->attributes['date'] = null; // Set to null if invalid
        }
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function expenseType()
    {
        return $this->belongsTo(ExpenseType::class, 'expense_type');
    }

    public function foodType()
    {
        return $this->belongsTo(FoodType::class, 'food_type');
    }
}
