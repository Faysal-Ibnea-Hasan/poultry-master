<?php

namespace App\Filament\Resources\BroodingTemperatureResource\Pages;

use App\Filament\Resources\BroodingTemperatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBroodingTemperature extends ViewRecord
{
    protected static string $resource = BroodingTemperatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
