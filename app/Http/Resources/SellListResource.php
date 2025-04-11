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
            "id" => (string)$this->sell?->id,
            "batch_id" => (string)$this->sell?->batch_id,
            "batch_number" => (string)$this->sell?->batch?->batch_number,
            "customer_name" => (string)$this->sell?->customer_name,
            "sale_date" => (string)$this->sell?->sale_date,
            "sell_description" => (string)$this->sell_description,
            "sell_type" => (string)$this->product_type,
            "quantity" => (string)$this->quantity,
            "unit_price" => (string)$this->unit_price,
            "total_weight" => (string)$this->total_weight,
            "avg_weight" => (string)($this->total_weight / $this->quantity),
            "amount" => (string)$this->amount,
        ];
    }
}
