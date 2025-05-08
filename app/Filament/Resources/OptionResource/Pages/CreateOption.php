<?php

namespace App\Filament\Resources\OptionResource\Pages;

use App\Filament\Resources\OptionResource;
use App\Models\Option;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOption extends CreateRecord
{
    protected static string $resource = OptionResource::class;
    protected function handleRecordCreation(array $data): Option
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['name'] = $translations[$defaultLocale]['name'] ?? null;
        $data['title'] = $translations[$defaultLocale]['title'] ?? null;
        $data['sub_title'] = $translations[$defaultLocale]['sub_title'] ?? null;

        $option = Option::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $option->setTranslation($key, [$locale => $value]);
            }
        }

        return $option;
    }
}
