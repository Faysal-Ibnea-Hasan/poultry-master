<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedExpenseListResource extends JsonResource
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
            "batch" => $this->batch?->batch_number,
            "date" => $this->date,
            "expense_type_id" => $this->expense_type,
            "expense_type" => $this->expenseType?->type,
            "amount" => $this->amount,
            "number_of_sack" => $this->number_of_sack,
            "cost_per_sack" => $this->cost_per_sack,
            "food_type_id" => $this->food_type,
            "food_type" => $this->foodType?->name
        ];
    }
}
