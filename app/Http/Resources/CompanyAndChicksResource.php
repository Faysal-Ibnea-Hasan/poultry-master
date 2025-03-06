<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyAndChicksResource extends JsonResource
{

//    public static function collection($resource)
//    {
//        // Group the resource collection by 'type' before returning
//        return parent::collection($resource)->groupBy('type');
//    }
//
//    public function toArray($request)
//    {
//        return $this->breed?->name;
////        return [
////            "id" => $this->id,
////            "company" => $this->company?->name,
////            "breed" => $this->breed?->name,
////        ];
//    }
    public static function collection($resource)
    {
        return parent::collection($resource)
            ->groupBy('chickType.name')
            ->map(fn($items, $type) => [
                'name' => $type,
                'value' => $items->pluck('breed.name')->implode(",")
            ])
            ->values()
            ->toArray();
    }

    public function toArray($request)
    {
        return $this->breed?->name;
    }
}
