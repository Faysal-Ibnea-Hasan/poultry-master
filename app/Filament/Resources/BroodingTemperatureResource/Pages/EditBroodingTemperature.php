<?php

namespace App\Filament\Resources\BroodingTemperatureResource\Pages;

use App\Filament\Resources\BroodingTemperatureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBroodingTemperature extends EditRecord
{
    protected static string $resource = BroodingTemperatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
