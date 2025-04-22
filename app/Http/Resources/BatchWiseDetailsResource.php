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
        $total_avg_weight = $total_sells > 0 ? round($total_weight / $total_sells, 2) : 0;
        $total_sell_amount = $this->sells?->filter(function ($sell) {
            return $sell->sellLine?->product_type == 1;
        })->sum(function ($sell) {
            return (float)$sell->sellLine->amount;
        });
        $total_other_income = $this->sells?->filter(function ($sell) {
            return $sell->sellLine?->product_type == 2;
        })->sum(function ($sell) {
            return (float)$sell->sellLine->amount;
        });
        return [
            'batch_details' => [
                'batch_name' => (string)$this->batch_number,
                'chick_type' => (string)$this->chickType->name,
                'company_name' => (string)$this->company_name,
                'start_date' => (string)$this->created_at->format('d-m-Y'),
                'total_chicks' => (string)$this->quantity,
                'cost_per_chick' => (string)$this->cost_per_chick,
                'total_dead_chicks' => (string)$this->deadChickens?->sum('quantity'),
                'remaining_chicks' => (string)($this->quantity - $this->deadChickens?->sum('quantity')),
                'death_percentage' => $this->quantity > 0
                    ? number_format(($this->deadChickens?->sum('quantity') / $this->quantity) * 100, 2)
                    : 0,
                'chicks_age' => (string)round($this->created_at->diffInDays(now())),
            ],
            'food_details' => [
                'total_sack' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::FOOD->value;
                })->sum(function ($expense) {
                    return (float)$expense->number_of_sack;
                }),
            ],
            'expense_details' => [
                'total_expense' => (string)$this->expenses?->sum('amount'),
                'food_expense' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::FOOD->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'medicine_expense' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::MEDICINE->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'transport_expense' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::TRANSPORT->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'litter_expense' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::LITTER->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'labour_expense' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::LABOUR->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'electricity_expense' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::ELECTRICITY->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'cost_per_chick_expense' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::COST_PER_CHICK->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                }),
                'other_expense' => (string)$this->expenses?->filter(function ($expense) {
                    return $expense->expenseType?->type === ExpenseType::OTHER->value;
                })->sum(function ($expense) {
                    return (float)$expense->amount;
                })
            ],
            'sells_details' => [
                'total_sell' => (string)$total_sells,
                'total_weight' => (string)$total_weight,
                'total_avg_weight' => (string)$total_avg_weight,
                'total_sell_amount' => (string)$total_sell_amount
            ],
            'loss_profit' => [
                'total_sell_amount' => (string)$total_sell_amount,
                'total_other_income' => (string)$total_other_income,
                'total_expense' => (string)$this->expenses?->sum('amount'),
                'total_loss' => ($total_sell_amount + $total_other_income) < (string)$this->expenses?->sum('amount')
                    ?
                    (string)(($total_sell_amount + $total_other_income) - $this->expenses?->sum('amount'))
                    : "0",
                'total_profit' => ($total_sell_amount + $total_other_income) > (string)$this->expenses?->sum('amount')
                    ?
                    (string)(($total_sell_amount + $total_other_income) - $this->expenses?->sum('amount'))
                    : "0",
            ]
        ];
    }
}
