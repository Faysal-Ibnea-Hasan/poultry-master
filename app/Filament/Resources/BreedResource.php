<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BreedResource\Pages;
use App\Filament\Resources\BreedResource\RelationManagers;
use App\Models\Breed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BreedResource extends Resource
{
    protected static ?string $model = Breed::class;

    protected static ?string $navigationIcon = 'heroicon-s-bold';
    protected static ?int $navigationSort = 4; // Position in the navigation bar (lower = higher priority)

    public static function form(Form $form): Form
    {
        $locales = ['en' => 'English', 'bn' => 'বাংলা'];

        return $form
            ->schema([
                Forms\Components\Section::make('Translations')
                    ->schema([
                        Forms\Components\Tabs::make()
                            ->tabs(
                                collect($locales)->map(function ($label, $locale) {
                                    return Forms\Components\Tabs\Tab::make($label)
                                        ->schema([
                                            Forms\Components\Grid::make(2)->schema([
                                                Forms\Components\TextInput::make("translations.{$locale}.name")
                                                    ->label('Breed Name')
                                                    ->required()
                                                    ->maxLength(255),

                                                Forms\Components\TextInput::make("translations.{$locale}.purpose")
                                                    ->label('Purpose')
                                                    ->maxLength(50),
                                            ]),

                                            Forms\Components\Textarea::make("translations.{$locale}.description")
                                                ->label('Breed Description')
                                                ->columnSpanFull(),

                                            Forms\Components\Textarea::make("translations.{$locale}.characteristics")
                                                ->label('Characteristics')
                                                ->columnSpanFull(),
                                        ]);
                                })->toArray()
                            )
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Breed Info')
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('average_life_span')
                                ->label('Average Life Span (months)')
                                ->numeric(),

                            Forms\Components\TextInput::make('average_weight')
                                ->label('Average Weight (kg)')
                                ->numeric(),
                        ]),
                    ]),
            ]);
    }


    public static function shouldRegisterNavigation(): bool // Hide or show in navigation
    {
        return true;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('average_life_span')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('average_weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purpose')
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
            'index' => Pages\ListBreeds::route('/'),
            'create' => Pages\CreateBreed::route('/create'),
//            'view' => Pages\ViewBreed::route('/{record}'),
            'edit' => Pages\EditBreed::route('/{record}/edit'),
        ];
    }
}
