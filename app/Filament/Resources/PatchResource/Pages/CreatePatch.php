<?php

namespace App\Filament\Resources\PatchResource\Pages;

use App\Filament\Resources\PatchResource;
use App\Models\Patch;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatch extends CreateRecord
{
    protected static string $resource = PatchResource::class;
    protected function handleRecordCreation(array $data): Patch
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['title'] = $translations[$defaultLocale]['title'] ?? null;

        $patch = Patch::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $patch->setTranslation($key, [$locale => $value]);
            }
        }

        return $patch;
    }
}
