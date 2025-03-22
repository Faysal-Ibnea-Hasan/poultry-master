<?php

namespace App\Filament\Resources\FoodTypeResource\Pages;

use App\Filament\Resources\FoodTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFoodTypes extends ListRecords
{
    protected static string $resource = FoodTypeResource::class;
    protected static ?string $title = 'Feed Types'; // Updated list page title

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create Feed Type'),
        ];
    }
}
