<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DesignTypeResource\Pages;
use App\Filament\Resources\DesignTypeResource\RelationManagers;
use App\Models\DesignType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DesignTypeResource extends Resource
{
    protected static ?string $model = DesignType::class;

    protected static ?string $navigationIcon = 'heroicon-s-paint-brush';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->label('Type')
                    ->disabled() // Makes the field non-editable
                    ->default(fn($get, $record) => $record?->type ?? '') // Ensures the value is shown
                    ->dehydrated(), // Ensures it's still part of the form submission
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->unique('design_types', 'order', ignoreRecord: true)
                    ->default(null),
                Forms\Components\Toggle::make('isPro')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),

                IconColumn::make('isPro')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('status')
                    ->boolean()
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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDesignTypes::route('/'),
        ];
    }
}
