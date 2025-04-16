<?php

namespace App\Http\Resources;

use App\Enum\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchWiseDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $total_sells = $this->sells?->filter(function ($sell) {
            return $sell->sellLine?->product_type == 1;
        })->sum(function ($sell) {
            return (float)$sell->sellLine->quantity;
        });
        $total_weight = $this->sells?->filter(function ($sell) {
            return $sell->sellLine?->product_type == 1;
        })->sum(function ($sell) {
            return (float)$sell->sellLine->total_weight;
        });
        $total_avg_weight = $total_sells > 0 ? round($total_weight / $total_sells,2) : 0;
        $total_sell_amount = $this->sells?->filter(function ($sell) {
            return $sell->sellLine?->product_type == 1;
        })->sum(function ($sell) {
            return (float)$sell->sellLine->amount;
        });
        return [
            'batch_details' => [
                'batch_name' => $this->batch_name,
                'chick_type' => $this->chick_type,
                'company_name' => $this->company_name,
                'start_date' => $this->created_at->format('d-m-Y'),
                'total_chicks' => $this->quantity,
                'cost_per_chick' => $this->cost_per_chick,
                'total_dead_chicks' => $this->deadChickens?->sum('quantity'),
                'remaining_chicks' => ($this->quantity - $this->deadChickens?->sum('quantity')),
                'death_percentage' => $this->quantity > 0
                    ? number_format(($this->deadChickens?->sum('quantity') / $this->quantity) * 100, 2)
                    : 0,
                'chicks_age' => (string)round($this->created_at->diffInDays(now())),
            ],
            'expense_details' => [
                'total_expense' => $this->expenses?->sum('amount'),
                'food_expense' => $this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::FOOD->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'medicine_expense' => $this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::MEDICINE->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'transport_expense' => $this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::TRANSPORT->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'litter_expense' => $this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::LITTER->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'labour_expense' => $this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::LABOUR->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'electricity_expense' => $this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::ELECTRICITY->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'cost_per_chick_expense' => $this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::COST_PER_CHICK->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'other_expense' => $this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::OTHER->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                })
            ],
            'sells_details' => [
                'total_sell' => $total_sells,
                'total_weight' => $total_weight,
                'total_avg_weight' => $total_avg_weight,
                'total_sell_amount' => $total_sell_amount
            ]
        ];
    }
}
