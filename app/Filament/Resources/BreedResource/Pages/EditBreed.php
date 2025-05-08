<?php

namespace App\Filament\Resources\BreedResource\Pages;

use App\Filament\Resources\BreedResource;
use App\Models\Breed;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBreed extends EditRecord
{
    protected static string $resource = BreedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
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
        $data['description'] = $translations[$defaultLocale]['description'] ?? $record->description;
        $data['purpose'] = $translations[$defaultLocale]['purpose'] ?? $record->purpose;
        $data['characteristics'] = $translations[$defaultLocale]['characteristics'] ?? $record->characteristics;

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
                'description' => $this->record->getTranslation('description', $locale),
                'purpose' => $this->record->getTranslation('purpose', $locale),
                'characteristics' => $this->record->getTranslation('characteristics', $locale),
            ];
        }

        $data['translations'] = $translations;

        return $data;
    }
}
