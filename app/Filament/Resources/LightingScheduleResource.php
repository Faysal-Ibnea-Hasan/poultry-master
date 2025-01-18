<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LightingScheduleResource\Pages;
use App\Filament\Resources\LightingScheduleResource\RelationManagers;
use App\Models\LightingSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LightingScheduleResource extends Resource
{
    protected static ?string $model = LightingSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-s-light-bulb';
    protected static ?int $navigationSort = 6; // Position in the navigation bar (lower = higher priority)

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
                Forms\Components\TextInput::make('light_hours')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('light_intensity')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('start_time'),
                Forms\Components\TextInput::make('end_time'),
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
                Tables\Columns\TextColumn::make('light_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('light_intensity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('end_time'),
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
            'index' => Pages\ListLightingSchedules::route('/'),
            'create' => Pages\CreateLightingSchedule::route('/create'),
            'view' => Pages\ViewLightingSchedule::route('/{record}'),
            'edit' => Pages\EditLightingSchedule::route('/{record}/edit'),
        ];
    }
}
