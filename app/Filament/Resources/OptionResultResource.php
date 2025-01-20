<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionResultResource\Pages;
use App\Filament\Resources\OptionResultResource\RelationManagers;
use App\Models\Breed;
use App\Models\Option;
use App\Models\OptionAttribute;
use App\Models\OptionResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OptionResultResource extends Resource
{
    protected static ?string $model = OptionResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('option_id')
                    ->label('Option')
                    ->required()
                    ->searchable()
                    ->options(function () {
                        return Option::all()->pluck('name', 'id'); // 'id' will be submitted as the value
                    }),
                Forms\Components\Select::make('breed_id')
                    ->label('Breed')
                    ->required()
                    ->searchable()
                    ->options(function () {
                        return Breed::all()->pluck('name', 'id'); // 'id' will be submitted as the value
                    }),
                Forms\Components\Select::make('option_attribute_id')
                    ->label('Attribute')
                    ->searchable()
                    ->options(function () {
                        return OptionAttribute::all()->pluck('name', 'id'); // 'id' will be submitted as the value
                    }),
                Forms\Components\TextInput::make('value')
                    ->label('Value')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('day')
                    ->label('Day')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('option.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('breed.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attribute.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day')
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
            'index' => Pages\ListOptionResults::route('/'),
            'create' => Pages\CreateOptionResult::route('/create'),
            'view' => Pages\ViewOptionResult::route('/{record}'),
            'edit' => Pages\EditOptionResult::route('/{record}/edit'),
        ];
    }
}
