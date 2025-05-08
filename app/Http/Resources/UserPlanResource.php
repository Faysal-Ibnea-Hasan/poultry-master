<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPlanResource extends JsonResource
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
            "user_id" => (string)$this->user_id,
            "subscription_id" => (string)$this->subscription_id,
            "subscription_name" => $this->subscription?->plan_name,
            "subscription_type" => $this->subscription?->type,
            "price" => $this->subscription?->offer_price,
            "remaining_days" => (string)round(now()->diffInDays($this->end_date, true)),
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "payment_status" => $this->payment_status,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
