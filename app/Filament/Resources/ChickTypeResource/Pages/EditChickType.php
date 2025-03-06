<?php

namespace App\Filament\Resources\ChickTypeResource\Pages;

use App\Filament\Resources\ChickTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChickType extends EditRecord
{
    protected static string $resource = ChickTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
