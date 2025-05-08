<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionResultResource\Pages;
use App\Filament\Resources\OptionResultResource\RelationManagers;
use App\Models\Breed;
use App\Models\Company;
use App\Models\CompanyAndChick;
use App\Models\Option;
use App\Models\OptionAttribute;
use App\Models\OptionResult;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OptionResultResource extends Resource
{
    protected static ?string $model = OptionResult::class;

    protected static ?string $navigationIcon = 'heroicon-s-magnifying-glass';
    protected static ?string $navigationGroup = 'Menu';
    protected static ?string $navigationLabel = 'Menu Results';
    protected static ?string $breadcrumb = 'Menu Results';

//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Select::make('option_id')
//                    ->label('Menu')
//                    ->required()
//                    ->searchable()
//                    ->options(fn() => Option::pluck('name', 'id'))
//                    ->reactive()
//                    ->afterStateUpdated(fn($state, callable $set) => $set('design_type', Option::find($state)?->designType?->type)),
//
//                TextInput::make('design_type')
//                    ->label('Design Type')
//                    ->disabled()
//                    ->default(fn($get) => Option::find($get('option_id'))?->designType?->type)
//                    ->dehydrated()
//                    ->visible(fn($get) => filled($get('design_type'))),
//
//                // Fields when design_type is 'Result'
//                Section::make('Result Fields')
//                    ->schema([
//                        Select::make('breed_id')
//                            ->label('Breed')
//                            ->required()
//                            ->searchable()
//                            ->options(fn() => Breed::pluck('name', 'id')),
//
//                        Select::make('option_attribute_id')
//                            ->label('Attribute')
//                            ->searchable()
//                            ->options(fn() => OptionAttribute::pluck('name', 'id')),
//
//                        TextInput::make('value')
//                            ->label('Value')
//                            ->maxLength(255)
//                            ->default(null),
//
//                        TextInput::make('day')
//                            ->label('Day')
//                            ->numeric()
//                            ->default(null),
//                    ])
//                    ->visible(fn($get) => $get('design_type') === 'Result'), // Using type name instead of ID
//
//                // Fields when design_type is 'list'
//                Section::make('List Fields')
//                    ->schema([
//                        Grid::make(2)->schema([
//                            Select::make('company_id')
//                                ->label('Company')
//                                ->required()
//                                ->searchable()
//                                ->options(fn() => Company::pluck('name', 'id')),
//
//                            Select::make('type')
//                                ->label('Type')
//                                ->required()
//                                ->options([
//                                    'broiler' => 'Broiler',
//                                    'layer' => 'Layer',
//                                ]),
//                        ]),
//
//                        Repeater::make('breeds')
//                            ->label('Breeds')
//                            ->schema([
//                                Select::make('breed_id')
//                                    ->label('Breed')
//                                    ->required()
//                                    ->searchable()
//                                    ->options(fn() => Breed::pluck('name', 'id')),
//                            ])
//                            ->addable(true)
//                            ->reorderable(true),
//                    ])
//                    ->visible(fn($get) => $get('design_type') === 'List'), // Using type name instead of ID
//            ]);
//    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('option_id')
                        ->label('Menu')
                        ->required()
                        ->searchable()
                        ->options(fn() => Option::pluck('name', 'id'))
                        ->reactive()
                        ->afterStateUpdated(fn($state, callable $set) => $set('design_type', Option::find($state)?->designType?->type)
                        ),

                    TextInput::make('design_type')
                        ->label('Design Type')
                        ->disabled()
                        ->default(fn($get) => Option::find($get('option_id'))?->designType?->type)
                        ->dehydrated()
                        ->visible(fn($get) => filled($get('design_type')))
                        ->afterStateHydrated(fn($state, callable $set, $record) => $set('design_type', $record?->option?->designType?->type)
                        )
                        ->extraAttributes(['class' => 'text-blue-600 font-semibold']),
                ])
                    ->columnSpanFull(),

                // Fields when design_type is 'Result'
                Section::make('Result Fields')
                    ->description('Fill in the required details for Result-based design.')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('breed_id')
                                ->label('🐾 Breed')
                                ->required()
                                ->searchable()
                                ->options(fn() => Breed::pluck('name', 'id'))
                                ->placeholder('Select a breed'),

                            Select::make('option_attribute_id')
                                ->label('📌 Attribute')
                                ->searchable()
                                ->options(fn() => OptionAttribute::pluck('name', 'id'))
                                ->placeholder('Choose an attribute'),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('value')
                                ->label('📏 Value')
                                ->maxLength(255)
                                ->default(null)
                                ->placeholder('Enter value...'),

                            TextInput::make('day')
                                ->label('📅 Day')
                                ->numeric()
                                ->default(null)
                                ->placeholder('Enter number of days'),
                        ]),
                    ])
                    ->visible(fn($get) => $get('design_type') === 'Result'),

                // Fields when design_type is 'list'
                Section::make('📋 List Fields')
                    ->description('Provide details for list-based design.')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('company_id')
                                ->label('🏢 Company')
                                ->required()
                                ->searchable()
                                ->options(fn() => Company::pluck('name', 'id'))
                                ->placeholder('Select a company'),

                            Select::make('type')
                                ->label('🐔 Type')
                                ->required()
                                ->options([
                                    'broiler' => 'Broiler',
                                    'layer' => 'Layer',
                                ])
                                ->placeholder('Choose type'),
                        ]),

                        Repeater::make('breeds')
                            ->label('🐾 Breeds')
                            ->schema([
                                Select::make('breed_id')
                                    ->label('🦆 Breed')
                                    ->required()
                                    ->searchable()
                                    ->options(fn() => Breed::pluck('name', 'id')),
                            ])
                            ->addable(true)
                            ->reorderable(true)
                            ->columnSpanFull(),
                    ])
                    ->visible(fn($get) => $get('design_type') === 'List'),
                // Fields when design_type is 'static'
                Section::make('📋 Static Fields')
                    ->description('Provide details for static design.')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('option_id')
                                ->label('📋 Menu')
                                ->options(fn() => Option::pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->placeholder('Select a menu'),

                            TextInput::make('title')
                                ->label('📝 Title')
                                ->maxLength(255)
                                ->default(null),
                        ]),

                        TextInput::make('sub_title')
                            ->label('📌 Subtitle')
                            ->maxLength(255)
                            ->default(null)
                            ->columnSpanFull(),

                        FileUpload::make('file')
                            ->label('📎 File Upload')
                            ->disk('public')
                            ->visibility('public')
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->visible(fn($get) => $get('design_type') === 'Static'),
            ])
            ->columns(2); // Makes the form layout more structured
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('option.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('breed.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attribute.name')
                    ->numeric()
                    ->searchable()
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
