<?php

namespace App\Filament\Resources\VaccinationScheduleResource\Pages;

use App\Filament\Resources\VaccinationScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVaccinationSchedule extends EditRecord
{
    protected static string $resource = VaccinationScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
