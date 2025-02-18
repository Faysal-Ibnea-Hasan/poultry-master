<?php

namespace App\Filament\Resources\DesignTypeResource\Pages;

use App\Filament\Resources\DesignTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDesignType extends EditRecord
{
    protected static string $resource = DesignTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
