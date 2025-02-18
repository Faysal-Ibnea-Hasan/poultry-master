<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'menu' => $this->groupBy(fn($item) => $item->designType->type ?? 'Unknown')->map(function ($items, $designType) {
                return [
                    'total' => count($items),
                    'sort' => $items->min(fn($item) => $item->designType->order ?? PHP_INT_MAX),
                    'design' => ucfirst($designType),
                    'isVisible' => true,
                    'menuList' => $items->map(function ($item) {
                        return [
                            'sort' => $item->order,
                            'title' => $item->name,
                            'dynamicTitle' => $item->title ?? "",
                            'image' => "//" . $item->image, // Modify as needed
                            'isVisible' => $item->status == 1,
                            'isPro' => $item->isPro == 1
                        ];
                    })->toArray()
                ];
            })->values()->toArray()
        ];
    }

}
