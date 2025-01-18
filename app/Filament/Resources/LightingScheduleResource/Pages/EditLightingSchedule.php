<?php

namespace App\Filament\Resources\LightingScheduleResource\Pages;

use App\Filament\Resources\LightingScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLightingSchedule extends EditRecord
{
    protected static string $resource = LightingScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
