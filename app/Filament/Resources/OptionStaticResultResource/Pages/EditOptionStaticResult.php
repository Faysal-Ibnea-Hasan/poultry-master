<?php

namespace App\Filament\Resources\OptionStaticResultResource\Pages;

use App\Filament\Resources\OptionStaticResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOptionStaticResult extends EditRecord
{
    protected static string $resource = OptionStaticResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
