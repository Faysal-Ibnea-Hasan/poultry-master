<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionResource\Pages;
use Filament\Infolists\Components\Grid;
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

    protected static ?string $navigationIcon = 'heroicon-s-wrench-screwdriver';
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
                    ->placeholder('Enter a menu name')
                    ->unique(table: 'options', column: 'name'), // Ensure uniqueness
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
                        'calculator' => 'Calculator', // 'result' is the value, 'Result View' is the label
                    ])
                    ->placeholder('Select a design type'),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema(
                fn($record) => collect($record->results)
                    ->groupBy(fn($result) => optional($result->breed)->name ?? 'Unknown Breed') // Group by Breed first
                    ->map(fn($results, $breedName) => Section::make("Breed: $breedName") // Section for each Breed
                    ->schema(
                        collect($results)
                            ->groupBy('day') // Now group by Day within each Breed
                            ->map(fn($dayResults, $day) => Section::make("Day: $day") // Section for each Day
                            ->schema([
                                Grid::make(3) // ✅ 3 Columns Per Row
                                ->schema(
                                    collect($dayResults)->map(fn($result) => [
                                        TextEntry::make("results_{$result->id}_day")
                                            ->label('Day')
                                            ->default($result->day),
                                        TextEntry::make("results_{$result->id}_attribute")
                                            ->label('Attribute')
                                            ->default(optional($result->attribute)->name),
                                        TextEntry::make("results_{$result->id}_value")
                                            ->label('Value')
                                            ->default($result->value),

                                    ])->flatten()->toArray()
                                ),
                            ])
                            )->values()->toArray() // Convert to array
                    )
                    )->values()->toArray() // Convert to array
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
