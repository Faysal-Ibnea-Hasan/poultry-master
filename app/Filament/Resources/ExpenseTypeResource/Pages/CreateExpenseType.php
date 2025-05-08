<?php

namespace App\Filament\Resources\ExpenseTypeResource\Pages;

use App\Models\ExpenseType;
use App\Filament\Resources\ExpenseTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpenseType extends CreateRecord
{
    protected static string $resource = ExpenseTypeResource::class;
    protected function handleRecordCreation(array $data): ExpenseType
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['name'] = $translations[$defaultLocale]['name'] ?? null;

        $expenseType = ExpenseType::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $expenseType->setTranslation($key, [$locale => $value]);
            }
        }

        return $expenseType;
    }
}
