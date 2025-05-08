<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            "plan_name" => $this->plan_name,
            'image' => asset('uploads/' . $this->image),(string)
            "type" => $this->type,
            "regular_price" => $this->regular_price,
            "offer_price" => $this->offer_price,
            "duration_days" => (string)$this->duration_days,
            "status" => (string)$this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
