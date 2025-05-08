<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChickTypeResource\Pages;
use App\Filament\Resources\ChickTypeResource\RelationManagers;
use App\Models\ChickType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChickTypeResource extends Resource
{
    protected static ?string $model = ChickType::class;

    protected static ?string $navigationIcon = 'heroicon-s-list-bullet';

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
            'index' => Pages\ListChickTypes::route('/'),
            'create' => Pages\CreateChickType::route('/create'),
            'edit' => Pages\EditChickType::route('/{record}/edit'),
        ];
    }
}
