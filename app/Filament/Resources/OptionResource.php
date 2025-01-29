<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionResource\Pages;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use App\Models\Option;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class OptionResource extends Resource
{
    protected static ?string $model = Option::class;
    protected static ?string $title = 'Menu';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Menu';
    protected static ?string $navigationLabel = 'Menu';
    protected static ?string $breadcrumb = 'Menu';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Menu Name')
                    ->maxLength(255)
                    ->placeholder('Enter a menu name'),
                Forms\Components\TextInput::make('title')
                    ->label('Dynamic Title')
                    ->maxLength(255)
                    ->placeholder('Enter a custom title'),
                Forms\Components\FileUpload::make('image') // Correct component for file uploads
                ->label('Image')
                    ->image() // Specify this is for image uploads
                    ->disk('public') // Ensure the disk is configured in filesystem config
                    ->visibility('public')
                    ->nullable(),
                Forms\Components\Select::make('design_type')
                    ->label('Design Type')
                    ->required()
                    ->options([
                        'list' => 'List', // 'list' is the value, 'List View' is the label
                        'result' => 'Result', // 'result' is the value, 'Result View' is the label
                    ])
                    ->placeholder('Select a design type'),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema(
                fn($record) => collect($record->results)
                    ->groupBy('day') // Group by 'day'
                    ->map(fn($results, $day) =>
                    Section::make("Day: $day") // Create a section for each day
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('title'),
                        TextEntry::make('design_type'),

                        // Iterate over results for that day
                        ...collect($results)->map(fn($result) => [
                            TextEntry::make("results_{$result->id}_value")
                                ->label('Value')
                                ->default($result->value),

                            TextEntry::make("results_{$result->id}_attribute")
                                ->label('Attribute')
                                ->default(optional($result->attribute)->name),

                            TextEntry::make("results_{$result->id}_breed")
                                ->label('Breed')
                                ->default(optional($result->breed)->name),
                        ])->flatten()->toArray(),
                    ])
                    )->values()->toArray() // Convert to an array for Filament
            );
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Menu Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Dynamic Title')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('design_type')
                    ->label('Design Type')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                ImageColumn::make('image')
                    ->disk('public')


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
            'index' => Pages\ListOptions::route('/'),
            'create' => Pages\CreateOption::route('/create'),
            'view' => Pages\ViewOption::route('/{record}'),
            'edit' => Pages\EditOption::route('/{record}/edit'),
        ];
    }
}
