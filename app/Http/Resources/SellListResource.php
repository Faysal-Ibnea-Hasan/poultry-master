<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "batch_id" => $this->batch_id,
            "batch_number" => $this->batch?->batch_number,
            "customer_name" => $this->customer_name,
            "sale_date" => $this->sale_date,
            "sell_description" => $this->sellLine?->sell_description,
            "sell_type" => $this->sellLine?->product_type,
            "quantity" => $this->sellLine?->quantity,
            "unit_price" => $this->sellLine?->unit_price,
            "total_weight" => $this->sellLine?->total_weight,
            "amount" => $this->sellLine?->amount,
        ];
    }
}
