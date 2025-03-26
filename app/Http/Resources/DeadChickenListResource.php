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
            'id' => (string)$this->id,
            'batch_id' => (string)$this->batch_id,
            'batch_number' => (string)$this->batch?->batch_number,
            'quantity' => (string)$this->quantity,
            'date' => (string)$this->date,
            'reason' => (string)$this->reason
        ];
    }
}
