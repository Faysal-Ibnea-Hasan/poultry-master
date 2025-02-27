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
            'contents' => $this->groupBy(fn($item) => $item->patches->first()->code ?? 'Unknown') // Group by patch code
            ->map(function ($items, $patchCode) { // $patchCode is the key for each group
                return [
                    'total' => count($items),
                    'patch_code' => $patchCode, // Use the group key as patch code
                    'patch_title' => $items->first()->patches->first()->title ?? 'Unknown', // Get title from the first patch in the group
                    'sort' => $items->min(fn($item) => $item->patches->first()->order ?? PHP_INT_MAX),
                    'design' => ucfirst($items->first()->designType->type ?? 'Unknown'),
                    'isVisible' => true,
                    'menuList' => $items->map(function ($item) {
                        return [
                            'menu_id' => $item->id,
                            'sort' => $item->order,
                            'title' => $item->name,
                            'dynamicTitle' => $item->title ?? "",
                            'image' => asset('uploads/' . $item->image),
                            'sub_title' => $item->sub_title,
                            'content_type' => $item->content_type,
                            'link' => $item->link,
                            'action' => $item->action,
                            'isVisible' => $item->status == 1,
                            'isPro' => $item->isPro == 1
                        ];
                    })->toArray()
                ];
            })->values()->toArray()
        ];

    }

}
