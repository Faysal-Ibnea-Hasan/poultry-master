<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionResource\Pages;
use App\Models\CompanyAndChick;
use App\Models\Option;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;

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
                // 📌 Basic Information
                Fieldset::make('Basic Information')->schema([
                    TextInput::make('name')
                        ->label('Menu Name')
                        ->placeholder('Enter a menu name')
                        ->required()
                        ->maxLength(255)
                        ->unique(table: 'options', column: 'name', ignoreRecord: true),

                    TextInput::make('title')
                        ->label('Dynamic Title')
                        ->placeholder('Enter a custom title')
                        ->maxLength(255),

                    TextInput::make('sub_title')
                        ->label('Subtitle')
                        ->placeholder('Enter a subtitle')
                        ->maxLength(255),

                    FileUpload::make('image')
                        ->label('Image')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->nullable(),
                ]),

                // 📌 Configuration Settings
                Fieldset::make('Configuration')->schema([
                    Select::make('design_type_id')
                        ->label('Design Type')
                        ->relationship('designType', 'type') // Assuming a relation
                        ->required()
                        ->placeholder('Select a design type'),

                    TextInput::make('content_type')
                        ->label('Content Type')
                        ->placeholder('Enter content type')
                        ->maxLength(255)
                        ->nullable(),

                    TextInput::make('link')
                        ->label('Link')
                        ->placeholder('Enter a link')
                        ->url()
                        ->nullable(),

                    TextInput::make('action')
                        ->label('Action')
                        ->placeholder('Enter an action (e.g., Home, Subscription)')
                        ->maxLength(255)
                        ->nullable(),

                    TextInput::make('order')
                        ->label('Order')
                        ->unique(table: 'options', column: 'order', ignoreRecord: true)
                        ->numeric()
                        ->required()
                        ->default(fn() => Option::max('order') + 1) // Auto-increment order
                ]),

                // 📌 Status Controls
                Fieldset::make('Status Controls')
                    ->columns(2)
                    ->schema([
                        Toggle::make('status')->label('Active')->onColor('success'),
                        Toggle::make('isPro')->label('Pro Feature')->onColor('warning'),
                    ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema(
            fn($record) => match ($record->design_type_id) {
                1 => self::renderResultInfo($record), // Assuming ID 1 is 'Result'
                2 => self::renderListInfo($record),       // Assuming ID 2 is 'list'
                default => [], // Fallback for unknown types
            }
        );
    }
    private static function renderResultInfo($record)
    {
        return collect($record->results)
            ->groupBy(fn($result) => optional($result->breed)->name ?? 'Unknown Breed') // Group by Breed first
            ->map(fn($results, $breedName) => Section::make("Breed: $breedName") // Section for each Breed
            ->schema(
                collect($results)
                    ->groupBy('day') // Now group by Day within each Breed
                    ->map(fn($dayResults, $day) => Section::make("Day: $day") // Section for each Day
                    ->schema([
                        Grid::make(3) // 3 Columns Per Row
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
            )->values()->toArray(); // Convert to array
    }

    private static function renderListInfo($record)
    {
        Log::info($record);
        // Get the data from the CompanyAndChick model, assuming it has a relationship with the OptionResult model
        $companyAndChicks = CompanyAndChick::where('option_id', $record->id)
            ->get();  // You can modify the query as needed to get the related data

        return $companyAndChicks->groupBy(fn($result) => optional($result->company)->name ?? 'Unknown Company') // First group by company
        ->map(fn($companyResults, $companyName) => Section::make("Company: $companyName") // Section for each Company
        ->schema(
            $companyResults->groupBy(fn($result) => optional($result->breed)->name ?? 'Unknown Breed') // Group by Breed next
            ->map(fn($breedResults, $breedName) => Section::make("Breed: $breedName") // Section for each Breed
            ->schema(
                $breedResults->groupBy('type') // Group by Type within each Breed
                ->map(fn($typeResults, $type) => Section::make("Type: $type") // Section for each Type
                ->schema([
                    Grid::make(3) // 3 Columns Per Row
                    ->schema(
                        collect($typeResults)->map(fn($result) => [
                            TextEntry::make("results_{$result->id}_company")
                                ->label('Company')
                                ->default(optional($result->company)->name),
                            TextEntry::make("results_{$result->id}_breed")
                                ->label('Breed')
                                ->default(optional($result->breed)->name),
                            TextEntry::make("results_{$result->id}_type")
                                ->label('Type')
                                ->default($result->type),
                        ])->flatten()->toArray()
                    ),
                ])
                )->values()->toArray() // Convert to array
            )
            )->values()->toArray() // Convert to array
        )
        )->values()->toArray(); // Convert to array
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

                Tables\Columns\TextColumn::make('designType.type') // Assuming a relation
                ->label('Design Type')
                    ->sortable()
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->sortable()
                    ->searchable(),

                // ✅ Toggle for 'status' field
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status')
                    ->onColor('success')
                    ->sortable()
                    ->afterStateUpdated(fn($record) => Notification::make()
                        ->title('Status Updated')
                        ->body("The status is now " . ($record->status ? '✅ Active' : '❌ Inactive'))
                        ->success()
                        ->send()
                    ),

                // ✅ Toggle for 'isPro' field
                Tables\Columns\ToggleColumn::make('isPro')
                    ->label('Pro Feature')
                    ->onColor('success')
                    ->sortable()
                    ->afterStateUpdated(fn($record) => Notification::make()
                        ->title('Pro Feature Updated')
                        ->body("The Pro Feature is now " . ($record->isPro ? '✅ Enabled' : '❌ Disabled'))
                        ->success()
                        ->send()
                    ),

                ImageColumn::make('image')
                    ->disk('public')
                    ->label('Image')
                    ->size(50),
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
