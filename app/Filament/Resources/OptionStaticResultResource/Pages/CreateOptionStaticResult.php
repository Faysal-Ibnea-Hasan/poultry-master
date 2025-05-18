<?php

namespace App\Filament\Resources\OptionStaticResultResource\Pages;

use App\Filament\Resources\OptionStaticResultResource;
use App\Models\OptionStaticResult;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOptionStaticResult extends CreateRecord
{
    protected static string $resource = OptionStaticResultResource::class;
    protected function handleRecordCreation(array $data): OptionStaticResult
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['title'] = $translations[$defaultLocale]['title'] ?? null;
        $data['sub_title'] = $translations[$defaultLocale]['sub_title'] ?? null;
        $data['file'] = $translations[$defaultLocale]['file'] ?? null;

        $result = OptionStaticResult::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $result->setTranslation($key, [$locale => $value]);
            }
        }

        return $result;
    }
}
