<?php

namespace App\Filament\Resources\VaccinationScheduleResource\Pages;

use App\Filament\Resources\VaccinationScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVaccinationSchedules extends ListRecords
{
    protected static string $resource = VaccinationScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
