<?php

namespace App\Filament\Resources\DeadChickenResource\Pages;

use App\Filament\Resources\DeadChickenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeadChicken extends EditRecord
{
    protected static string $resource = DeadChickenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
