<?php

namespace App\Filament\Resources\OptionAttributeResource\Pages;

use App\Filament\Resources\OptionAttributeResource;
use App\Models\OptionAttribute;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOptionAttribute extends CreateRecord
{
    protected static string $resource = OptionAttributeResource::class;
    protected function handleRecordCreation(array $data): OptionAttribute
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['name'] = $translations[$defaultLocale]['name'] ?? null;

        $attribute = OptionAttribute::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $attribute->setTranslation($key, [$locale => $value]);
            }
        }

        return $attribute;
    }
}
