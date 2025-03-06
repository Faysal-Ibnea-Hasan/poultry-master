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

                'contents' => $this->resource->map(function ($patch) {
                    return [
                        'total' => $patch->options->count(),
                        'sort' => $patch->order,
                        'code' => $patch->code,
                        'title' => $patch->title,
                        'content_type' => $patch->content_type,
                        'design' => ucfirst(optional($patch->designType)->type ?? 'Unknown'),
                        'isVisible' => $patch->status == 1,
                        'menuList' => $patch->options->map(function ($option) {
                            return [
                                'menu_id' => $option->id,
                                'sort' => $option->order,
                                'title' => $option->name,
                                'dynamicTitle' => $option->title ?? '',
                                'image' => asset('uploads/' . $option->image),
                                'sub_title' => $option->sub_title,
                                'content_type' => $option->content_type,
                                'link' => $option->link,
                                'action' => $option->action,
                                'isVisible' => $option->status == 1,
                                'isPro' => $option->isPro == 1
                            ];
                        })->toArray()
                    ];
                })->sortBy('sort')->values()->toArray()
            ];
    }
}
