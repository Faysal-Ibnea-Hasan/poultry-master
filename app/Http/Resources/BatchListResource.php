<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BatchListResource extends JsonResource
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
            "batch_number" => $this->batch_number,
            "chick_type_id" => $this->chick_type_id,
            "chick_type" => $this->chickType->name,
            "company_name" => $this->company_name,
            "quantity" => $this->quantity,
            "dead_quantity" => $this->deadChickens?->sum('quantity'),
            "final_quantity" => $this->quantity - $this->deadChickens?->sum('quantity') ?? 0,
            "cost_per_chick" => $this->cost_per_chick,
            "arrival_date" => $this->arrival_date
        ];
    }
}
