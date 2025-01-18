<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VaccinationScheduleResource\Pages;
use App\Filament\Resources\VaccinationScheduleResource\RelationManagers;
use App\Models\VaccinationSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VaccinationScheduleResource extends Resource
{
    protected static ?string $model = VaccinationSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';
    protected static ?int $navigationSort = 12; // Position in the navigation bar (lower = higher priority)

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('batch_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('disease_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('category_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('vaccine_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('scheduled_date'),
                Forms\Components\DatePicker::make('actual_date'),
                Forms\Components\TextInput::make('dosage')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('administration_method')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('administered_by')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('cost')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),
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
                Tables\Columns\TextColumn::make('disease_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vaccine_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('scheduled_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('actual_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dosage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('administration_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('administered_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cost')
                    ->money()
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
            'index' => Pages\ListVaccinationSchedules::route('/'),
            'create' => Pages\CreateVaccinationSchedule::route('/create'),
            'view' => Pages\ViewVaccinationSchedule::route('/{record}'),
            'edit' => Pages\EditVaccinationSchedule::route('/{record}/edit'),
        ];
    }
}
