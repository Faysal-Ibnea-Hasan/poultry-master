<?php

namespace App\Filament\Resources\OptionListResource\Pages;

use App\Filament\Resources\OptionListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOptionList extends EditRecord
{
    protected static string $resource = OptionListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
