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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OptionResultResource extends Resource
{
    protected static ?string $model = OptionResult::class;

    protected static ?string $navigationIcon = 'heroicon-s-magnifying-glass';
    protected static ?string $navigationGroup = 'Menu';
    protected static ?string $navigationLabel = 'Menu Results';
    protected static ?string $breadcrumb = 'Menu Results';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('option_id')
                    ->label('Menu')
                    ->required()
                    ->searchable()
                    ->options(fn() => Option::pluck('name', 'id'))
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('design_type', Option::find($state)?->design_type)),

                TextInput::make('design_type')
                    ->label('Design Type')
                    ->disabled()
                    ->default(fn($get) => Option::find($get('option_id'))?->design_type)
                    ->visible(fn($get) => filled($get('design_type'))),

                // Fields when design_type is 'calculator'
                Section::make('Calculator Fields')
                    ->schema([
                        Select::make('breed_id')
                            ->label('Breed')
                            ->required()
                            ->searchable()
                            ->options(fn() => Breed::pluck('name', 'id')),

                        Select::make('option_attribute_id')
                            ->label('Attribute')
                            ->searchable()
                            ->options(fn() => OptionAttribute::pluck('name', 'id')),

                        TextInput::make('value')
                            ->label('Value')
                            ->maxLength(255)
                            ->default(null),

                        TextInput::make('day')
                            ->label('Day')
                            ->numeric()
                            ->default(null),
                    ])
                    ->visible(fn($get) => $get('design_type') === 'calculator'),

                // Fields when design_type is 'list'
                Section::make('List Fields')
                    ->schema([
                        Select::make('company_id')
                            ->label('Company')
                            ->required()
                            ->searchable()
                            ->options(fn() => Company::pluck('name', 'id')),

                        Select::make('breed_id')
                            ->label('Breed')
                            ->required()
                            ->searchable()
                            ->options(fn() => Breed::pluck('name', 'id')),

                        Select::make('type')
                            ->label('Type')
                            ->required()
                            ->options([
                                'broiler' => 'Broiler',
                                'layer' => 'Layer',
                            ]),
                    ])
                    ->visible(fn($get) => $get('design_type') === 'list'),
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        \Log::info('Form Data:', $data); // Debugging: Check what data is actually being passed
        // You can also manipulate data based on design_type
        if ($data['design_type'] === 'list') {
            // Perform logic for 'list' design type (e.g., creating a related record)
            CompanyAndChick::create([
                'option_id' => $data['option_id'],
                'company_id' => $data['company_id'],
                'breed_id' => $data['breed_id'],
                'type' => $data['type'],
            ]);
        }

        return $data; // Return the mutated data
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
                Tables\Columns\TextColumn::make('type')
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
