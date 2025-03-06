<?php

namespace App\Filament\Resources\ChickTypeResource\Pages;

use App\Filament\Resources\ChickTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChickTypes extends ListRecords
{
    protected static string $resource = ChickTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
