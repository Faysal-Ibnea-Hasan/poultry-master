<?php

namespace App\Filament\Resources\CompanyAndChickResource\Pages;

use App\Filament\Resources\CompanyAndChickResource;
use App\Models\CompanyAndChick;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanyAndChick extends CreateRecord
{
    protected static string $resource = CompanyAndChickResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['name'] = $translations[$defaultLocale]['name'] ?? null;
        $records = collect($data['breeds'])->map(function ($breed) use ($data) {
            return [
                'option_id' => $data['option_id'],
                'company_id' => $data['company_id'],
                'chick_type_id' => $data['chick_type_id'],
                'breed_id' => $breed['breed_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        // Insert all records in one query (better performance)
        $companyChicks = CompanyAndChick::insert($records->toArray());
        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $companyChicks->setTranslation($key, [$locale => $value]);
            }
        }
        // Return the first inserted record as a fresh model instance
        return CompanyAndChick::where([
            'option_id' => $data['option_id'],
            'company_id' => $data['company_id'],
            'chick_type_id' => $data['chick_type_id'],
        ])->firstOrNew();
    }

}
