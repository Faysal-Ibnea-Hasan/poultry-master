<?php

namespace App\Filament\Resources\OptionResultResource\Pages;

use App\Filament\Resources\OptionResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOptionResult extends ViewRecord
{
    protected static string $resource = OptionResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
