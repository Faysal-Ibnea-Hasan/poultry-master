<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BreedResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static function collection($resource)
    {
        return parent::collection($resource)
            ->groupBy('attribute.name')
            ->map(fn($items, $attributeName) => [
                'name' => $attributeName,
                'value' => $items->pluck('value')->implode("\n") // No JSON encoding
            ])
            ->values()
            ->toArray();
    }

    public function toArray($request)
    {
        return [
            'name' => $this->attribute?->name,
            'value' => $this->value, // Direct string value
        ];
    }


}
