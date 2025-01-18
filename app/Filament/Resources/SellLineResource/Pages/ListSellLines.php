<?php

namespace App\Filament\Resources\SellLineResource\Pages;

use App\Filament\Resources\SellLineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSellLines extends ListRecords
{
    protected static string $resource = SellLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
