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
            "id" => (string)$this->id,
            "batch_id" => (string)$this->batch_id,
            "batch_number" => (string)$this->batch?->batch_number,
            "customer_name" => (string)$this->customer_name,
            "sale_date" => (string)$this->sale_date,
            "sell_description" => (string)$this->sellLine?->sell_description,
            "sell_type" => (string)$this->sellLine?->product_type,
            "quantity" => (string)$this->sellLine?->quantity,
            "unit_price" => (string)$this->sellLine?->unit_price,
            "total_weight" => (string)$this->sellLine?->total_weight,
            "avg_weight" => (string)($this->sellLine?->total_weight / $this->sellLine?->quantity),
            "amount" => (string)$this->sellLine?->amount,
        ];
    }
}
