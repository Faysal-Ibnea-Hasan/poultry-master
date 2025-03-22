<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BatchWiseDataListResource extends JsonResource
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
            "quantity" => $this->quantity,
            "arrival_date" => $this->arrival_date,
            "chick_type" => $this->chickType?->name,
        ];
    }
}
