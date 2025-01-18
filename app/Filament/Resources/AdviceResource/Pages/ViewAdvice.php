<?php

namespace App\Filament\Resources\AdviceResource\Pages;

use App\Filament\Resources\AdviceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAdvice extends ViewRecord
{
    protected static string $resource = AdviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
