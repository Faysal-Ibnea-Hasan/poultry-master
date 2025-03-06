<?php

namespace App\Filament\Resources\OptionPatchResource\Pages;

use App\Filament\Resources\OptionPatchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOptionPatch extends EditRecord
{
    protected static string $resource = OptionPatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
