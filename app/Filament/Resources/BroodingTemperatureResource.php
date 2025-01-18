<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BroodingTemperatureResource\Pages;
use App\Filament\Resources\BroodingTemperatureResource\RelationManagers;
use App\Models\BroodingTemperature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BroodingTemperatureResource extends Resource
{
    protected static ?string $model = BroodingTemperature::class;

    protected static ?string $navigationIcon = 'heroicon-s-fire';
    protected static ?int $navigationSort = 7; // Position in the navigation bar (lower = higher priority)

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('batch_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('day_number')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('target_temperature')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('actual_temperature')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('humidity_level')
                    ->numeric()
                    ->default(null),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
    public static function shouldRegisterNavigation(): bool // Hide or show in navigation
    {
        return false;
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('batch_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('target_temperature')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('actual_temperature')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('humidity_level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBroodingTemperatures::route('/'),
            'create' => Pages\CreateBroodingTemperature::route('/create'),
            'view' => Pages\ViewBroodingTemperature::route('/{record}'),
            'edit' => Pages\EditBroodingTemperature::route('/{record}/edit'),
        ];
    }
}
