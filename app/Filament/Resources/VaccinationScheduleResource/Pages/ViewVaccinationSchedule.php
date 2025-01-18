<?php

namespace App\Filament\Resources\VaccinationScheduleResource\Pages;

use App\Filament\Resources\VaccinationScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVaccinationSchedule extends ViewRecord
{
    protected static string $resource = VaccinationScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
