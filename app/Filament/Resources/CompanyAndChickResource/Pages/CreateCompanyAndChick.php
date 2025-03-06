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
        CompanyAndChick::insert($records->toArray());

        // Return the first inserted record as a fresh model instance
        return CompanyAndChick::where([
            'option_id' => $data['option_id'],
            'company_id' => $data['company_id'],
            'chick_type_id' => $data['chick_type_id'],
        ])->firstOrNew();
    }

}
