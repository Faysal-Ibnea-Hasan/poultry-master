<?php

namespace App\Filament\Resources\FoodTypeResource\Pages;

use App\Filament\Resources\FoodTypeResource;
use App\Models\FoodType;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFoodType extends CreateRecord
{
    protected static string $resource = FoodTypeResource::class;
    protected function handleRecordCreation(array $data): FoodType
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['name'] = $translations[$defaultLocale]['name'] ?? null;

        $foodType = FoodType::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $foodType->setTranslation($key, [$locale => $value]);
            }
        }

        return $foodType;
    }
}
