<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodTypeResource\Pages;
use App\Filament\Resources\FoodTypeResource\RelationManagers;
use App\Models\FoodType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FoodTypeResource extends Resource
{
    protected static ?string $model = FoodType::class;
    protected static ?string $navigationLabel = 'Feed Types';
    protected static ?string $breadcrumb = 'Feed Types';

    protected static ?string $navigationIcon = 'heroicon-s-archive-box';

    public static function form(Form $form): Form
    {
        $locales = ['en' => 'English', 'bn' => 'বাংলা'];
        return $form
            ->schema([
                Forms\Components\Tabs::make('Translations')
                    ->tabs(
                        collect($locales)->map(function ($label, $locale) {
                            return Forms\Components\Tabs\Tab::make($label)
                                ->schema([
                                    Forms\Components\TextInput::make("translations.{$locale}.name")
                                        ->required()
                                        ->maxLength(255),
                                ])->columns(1);
                        })->toArray()
                    ),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
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
            'index' => Pages\ListFoodTypes::route('/'),
            'create' => Pages\CreateFoodType::route('/create'),
            'edit' => Pages\EditFoodType::route('/{record}/edit'),
        ];
    }
}
