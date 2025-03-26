<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalQuantity = $this->sum('quantity');
        $totalWeight = $this->sum('total_weight');
        $chickSell = $this->where('product_type', 1)->sum('amount');
        $otherIncome = $this->where('product_type', 2)->sum('amount');
        $totalIncome = ($chickSell + $otherIncome);

        return [
            'total_quantity' => (string)$totalQuantity,
            'total_weight' => (string)$totalWeight,
            'total_avg' => (string)($totalQuantity ? number_format($totalWeight / $totalQuantity, 2) : '0.00'),
            'chick_sell' => (string)$chickSell,
            'other_income' => (string)$otherIncome,
            'total_income' => (string)$totalIncome,
        ];
    }
}
