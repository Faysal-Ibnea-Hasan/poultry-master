<?php

namespace App\Filament\Resources\OptionListResource\Pages;

use App\Filament\Resources\OptionListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptionLists extends ListRecords
{
    protected static string $resource = OptionListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
