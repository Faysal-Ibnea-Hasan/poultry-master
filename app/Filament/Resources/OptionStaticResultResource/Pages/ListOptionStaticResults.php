<?php

namespace App\Filament\Resources\OptionStaticResultResource\Pages;

use App\Filament\Resources\OptionStaticResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptionStaticResults extends ListRecords
{
    protected static string $resource = OptionStaticResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
