<?php

namespace App\Filament\Resources\OptionAttributeResource\Pages;

use App\Filament\Resources\OptionAttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptionAttributes extends ListRecords
{
    protected static string $resource = OptionAttributeResource::class;
    protected static ?string $title = 'Menu Attributes'; // Updated list page title

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-o-plus')->label('Add Attributes'),
        ];
    }
}
