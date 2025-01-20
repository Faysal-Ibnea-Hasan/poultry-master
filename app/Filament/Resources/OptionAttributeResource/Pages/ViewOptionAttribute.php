<?php

namespace App\Filament\Resources\OptionAttributeResource\Pages;

use App\Filament\Resources\OptionAttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOptionAttribute extends ViewRecord
{
    protected static string $resource = OptionAttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
