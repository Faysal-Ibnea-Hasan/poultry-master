<?php

namespace App\Filament\Resources\OptionStaticResultResource\Pages;

use App\Filament\Resources\OptionStaticResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOptionStaticResult extends EditRecord
{
    protected static string $resource = OptionStaticResultResource::class;

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
        $data['title'] = $translations[$defaultLocale]['title'] ?? $record->title;
        $data['sub_title'] = $translations[$defaultLocale]['sub_title'] ?? $record->sub_title;
        $data['file'] = $translations[$defaultLocale]['file'] ?? $record->sub_title;

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
                'title' => $this->record->getTranslation('title', $locale),
                'sub_title' => $this->record->getTranslation('sub_title', $locale),
                'file' => $this->record->getTranslation('file', $locale),
            ];
        }

        $data['translations'] = $translations;

        return $data;
    }
}
