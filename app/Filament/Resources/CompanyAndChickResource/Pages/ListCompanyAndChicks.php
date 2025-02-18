<?php

namespace App\Filament\Resources\CompanyAndChickResource\Pages;

use App\Filament\Resources\CompanyAndChickResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyAndChicks extends ListRecords
{
    protected static string $resource = CompanyAndChickResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add Company & Chick')->icon('heroicon-s-plus'),
        ];
    }
}
