<?php

namespace App\Filament\Resources\DesignTypeResource\Pages;

use App\Filament\Resources\DesignTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDesignTypes extends ListRecords
{
    protected static string $resource = DesignTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
