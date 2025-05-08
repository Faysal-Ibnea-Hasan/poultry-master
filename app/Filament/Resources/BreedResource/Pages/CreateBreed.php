<?php

namespace App\Filament\Resources\BreedResource\Pages;

use App\Filament\Resources\BreedResource;
use App\Models\Breed;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBreed extends CreateRecord
{
    protected static string $resource = BreedResource::class;
    protected function handleRecordCreation(array $data): Breed
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['name'] = $translations[$defaultLocale]['name'] ?? null;
        $data['description'] = $translations[$defaultLocale]['description'] ?? null;
        $data['purpose'] = $translations[$defaultLocale]['purpose'] ?? null;
        $data['characteristics'] = $translations[$defaultLocale]['characteristics'] ?? null;

        $breed = Breed::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $breed->setTranslation($key, [$locale => $value]);
            }
        }

        return $breed;
    }
}
