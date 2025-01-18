<?php

namespace App\Filament\Resources\SellLineResource\Pages;

use App\Filament\Resources\SellLineResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSellLine extends ViewRecord
{
    protected static string $resource = SellLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
