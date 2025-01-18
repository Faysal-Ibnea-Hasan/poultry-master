<?php

namespace App\Filament\Resources\LightingScheduleResource\Pages;

use App\Filament\Resources\LightingScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLightingSchedule extends ViewRecord
{
    protected static string $resource = LightingScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
