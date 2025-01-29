<?php

namespace App\Filament\Resources\OptionResultResource\Pages;

use App\Filament\Resources\OptionResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOptionResult extends EditRecord
{
    protected static string $resource = OptionResultResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

}
