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
            "id" => (string) $this->id,
            "batch_number" => (string) $this->batch_number,
            "chick_type_id" => (string) $this->chick_type_id,
            "chick_type" => (string) $this->chickType->name,
            "company_name" => (string) $this->company_name,
            "quantity" => (string) $this->quantity,
            "dead_quantity" => (string) ($this->deadChickens?->sum('quantity') ?? 0),
            "final_quantity" => (string) ($this->quantity - ($this->deadChickens?->sum('quantity') ?? 0)),
            "cost_per_chick" => (string) $this->cost_per_chick,
            "arrival_date" => (string) $this->arrival_date,
        ];
    }
}
