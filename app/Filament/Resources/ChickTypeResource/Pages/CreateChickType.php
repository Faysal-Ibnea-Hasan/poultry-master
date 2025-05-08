<?php

namespace App\Filament\Resources\ChickTypeResource\Pages;

use App\Filament\Resources\ChickTypeResource;
use App\Models\ChickType;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateChickType extends CreateRecord
{
    protected static string $resource = ChickTypeResource::class;
    protected function handleRecordCreation(array $data): ChickType
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['name'] = $translations[$defaultLocale]['name'] ?? null;

        $breed = ChickType::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $breed->setTranslation($key, [$locale => $value]);
            }
        }

        return $breed;
    }
}
