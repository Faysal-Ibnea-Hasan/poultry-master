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
    protected static ?string $navigationLabel = 'Menu Results';
    protected static ?string $breadcrumb = 'Menu Results';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('option_id')
                    ->label('Menu')
                    ->required()
                    ->searchable()
                    ->options(fn() => Option::pluck('name', 'id')) // Fetch options
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('design_type', Option::find($state)?->design_type)
                    ),

                Forms\Components\TextInput::make('design_type')
                    ->label('Design Type')
                    ->disabled()
                    ->default(fn($get) => Option::find($get('option_id'))?->design_type)
                    ->dehydrated(false)
                    ->visible(fn($get) => filled($get('design_type'))),

                Forms\Components\Select::make('breed_id')
                    ->label('Breed')
                    ->required()
                    ->searchable()
                    ->options(fn() => Breed::pluck('name', 'id'))
                    ->visible(fn($get) => Option::find($get('option_id'))?->design_type === 'result'),

                Forms\Components\Select::make('option_attribute_id')
                    ->label('Attribute')
                    ->searchable()
                    ->options(fn() => OptionAttribute::pluck('name', 'id'))
                    ->visible(fn($get) => Option::find($get('option_id'))?->design_type === 'result'),

                Forms\Components\TextInput::make('value')
                    ->label('Value')
                    ->maxLength(255)
                    ->default(null)
                    ->visible(fn($get) => Option::find($get('option_id'))?->design_type === 'result'),

                Forms\Components\TextInput::make('day')
                    ->label('Day')
                    ->numeric()
                    ->default(null)
                    ->visible(fn($get) => Option::find($get('option_id'))?->design_type === 'result'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\DeleteAction::make(),
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
