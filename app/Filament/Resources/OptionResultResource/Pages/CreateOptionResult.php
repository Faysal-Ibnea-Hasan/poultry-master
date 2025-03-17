<?php

namespace App\Filament\Resources\OptionResultResource\Pages;

use App\Filament\Resources\OptionResultResource;
use App\Models\CompanyAndChick;
use App\Models\OptionResult;
use App\Models\OptionStaticResult;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateOptionResult extends CreateRecord
{
    protected static string $resource = OptionResultResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        if ($data['design_type'] === 'List') {
            // Check if 'breeds' key exists to prevent undefined index error
            if (!isset($data['breeds']) || empty($data['breeds'])) {
                throw new \Exception('At least one breed must be selected.');
            }

            // Loop through the breeds array and create multiple records
            foreach ($data['breeds'] as $breed) {
                CompanyAndChick::create([
                    'option_id' => $data['option_id'],
                    'company_id' => $data['company_id'],
                    'breed_id' => $breed['breed_id'], // Access breed_id correctly
                    'type' => $data['type'],
                ]);
            }

            // Return the last created record (or modify if necessary)
            return CompanyAndChick::latest()->first();
        } elseif ($data['design_type'] === 'Static') {
            return OptionStaticResult::create([
                'option_id' => $data['option_id'],
                'title' => $data['title'] ?? null,
                'sub_title' => $data['sub_title'] ?? null,
                'file' => $data['file'] ?? null,
            ]);
        }

        return OptionResult::create($data);
    }


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirect to index page after creation
    }
}
