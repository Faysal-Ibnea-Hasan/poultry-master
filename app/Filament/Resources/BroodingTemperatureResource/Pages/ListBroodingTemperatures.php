<?php

namespace App\Filament\Resources\BroodingTemperatureResource\Pages;

use App\Filament\Resources\BroodingTemperatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBroodingTemperatures extends ListRecords
{
    protected static string $resource = BroodingTemperatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
