<?php

namespace App\Filament\Resources\ChickTypeResource\Pages;

use App\Filament\Resources\ChickTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChickType extends EditRecord
{
    protected static string $resource = ChickTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function handleRecordUpdate(\Illuminate\Database\Eloquent\Model $record, array $data): \Illuminate\Database\Eloquent\Model
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Update main table 'name' field with default locale value
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['name'] = $translations[$defaultLocale]['name'] ?? $record->name;

        $record->update($data);

        // ✅ Save translations
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $record->setTranslation($key, [$locale => $value]);
            }
        }

        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $translations = [];

        foreach (['en', 'bn'] as $locale) {
            $translations[$locale] = [
                'name' => $this->record->getTranslation('name', $locale),
            ];
        }

        $data['translations'] = $translations;

        return $data;
    }
}
