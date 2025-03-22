<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeadChickenListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'batch_id' => $this->batch_id,
            'batch_number' => $this->batch?->batch_number,
            'quantity' => $this->quantity,
            'date' => $this->date,
            'reason' => $this->reason
        ];
    }
}
