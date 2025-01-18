<?php

namespace App\Filament\Resources\SellLineResource\Pages;

use App\Filament\Resources\SellLineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSellLine extends EditRecord
{
    protected static string $resource = SellLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
