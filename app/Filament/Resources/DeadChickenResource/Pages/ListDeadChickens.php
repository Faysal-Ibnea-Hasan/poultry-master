<?php

namespace App\Filament\Resources\DeadChickenResource\Pages;

use App\Filament\Resources\DeadChickenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeadChickens extends ListRecords
{
    protected static string $resource = DeadChickenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
