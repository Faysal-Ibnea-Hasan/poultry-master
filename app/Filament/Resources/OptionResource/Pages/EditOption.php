<?php

namespace App\Filament\Resources\OptionResource\Pages;

use App\Filament\Resources\OptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOption extends EditRecord
{
    protected static string $resource = OptionResource::class;

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
        $data['title'] = $translations[$defaultLocale]['title'] ?? $record->title;
        $data['sub_title'] = $translations[$defaultLocale]['sub_title'] ?? $record->sub_title;

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
                'title' => $this->record->getTranslation('title', $locale),
                'sub_title' => $this->record->getTranslation('sub_title', $locale),
            ];
        }

        $data['translations'] = $translations;

        return $data;
    }
}
