<?php

namespace App\Filament\Resources\CompanyAndChickResource\Pages;

use App\Filament\Resources\CompanyAndChickResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyAndChick extends EditRecord
{
    protected static string $resource = CompanyAndChickResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
