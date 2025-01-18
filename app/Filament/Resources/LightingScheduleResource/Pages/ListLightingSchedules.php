<?php

namespace App\Filament\Resources\LightingScheduleResource\Pages;

use App\Filament\Resources\LightingScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLightingSchedules extends ListRecords
{
    protected static string $resource = LightingScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
