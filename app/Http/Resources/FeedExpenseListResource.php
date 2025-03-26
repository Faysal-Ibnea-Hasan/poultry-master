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
            "id" => (string)$this->id,
            "batch_id" => (string)$this->batch_id,
            "batch" => (string)$this->batch?->batch_number,
            "date" => (string)$this->date,
            "expense_type_id" => (string)$this->expense_type,
            "expense_type" => (string)$this->expenseType?->type,
            "amount" => (string)$this->amount,
            "number_of_sack" => (string)$this->number_of_sack,
            "cost_per_sack" => (string)$this->cost_per_sack,
            "food_type_id" => (string)$this->food_type,
            "food_type" => (string)$this->foodType?->name
        ];
    }
}
