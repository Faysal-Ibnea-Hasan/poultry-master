<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellLineResource\Pages;
use App\Filament\Resources\SellLineResource\RelationManagers;
use App\Models\SellLine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SellLineResource extends Resource
{
    protected static ?string $model = SellLine::class;

    protected static ?string $navigationIcon = 'heroicon-s-credit-card';
    protected static ?int $navigationSort = 11; // Position in the navigation bar (lower = higher priority)

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sell_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('product_type')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('unit_price')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('total_weight')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->default(null),
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
                Tables\Columns\TextColumn::make('sell_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_price')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
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
            'index' => Pages\ListSellLines::route('/'),
            'create' => Pages\CreateSellLine::route('/create'),
            'view' => Pages\ViewSellLine::route('/{record}'),
            'edit' => Pages\EditSellLine::route('/{record}/edit'),
        ];
    }
}
