<?php

namespace App\Filament\Resources\OptionResultResource\Pages;

use App\Filament\Resources\OptionResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptionResults extends ListRecords
{
    protected static string $resource = OptionResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
