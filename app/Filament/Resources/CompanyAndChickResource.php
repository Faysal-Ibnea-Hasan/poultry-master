<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyAndChickResource\Pages;
use App\Filament\Resources\CompanyAndChickResource\RelationManagers;
use App\Models\Breed;
use App\Models\ChickType;
use App\Models\Company;
use App\Models\CompanyAndChick;
use App\Models\Option;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanyAndChickResource extends Resource
{
    protected static ?string $model = CompanyAndChick::class;

    protected static ?string $navigationIcon = 'heroicon-s-circle-stack';
    protected static ?string $navigationGroup = 'Menu';
    protected static ?string $navigationLabel = 'Company & Chick';
    protected static ?string $breadcrumb = 'Company & Chick';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    Select::make('option_id')
                        ->label('Menu')
                        ->required()
                        ->searchable()
                        ->options(fn() => Option::pluck('name', 'id')),

                    Select::make('company_id')
                        ->label('Company')
                        ->required()
                        ->searchable()
                        ->options(fn() => Company::pluck('name', 'id')),

                    Select::make('chick_type_id')
                        ->label('Type')
                        ->required()
                        ->searchable()
                        ->options(fn() => ChickType::pluck('name', 'id')),
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
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('option.name')
                    ->label('Menu')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('company.name')
                    ->label('Company')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('breed.name')
                    ->label('Breed')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('chickType.name')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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
            'index' => Pages\ListCompanyAndChicks::route('/'),
            'create' => Pages\CreateCompanyAndChick::route('/create'),
            'edit' => Pages\EditCompanyAndChick::route('/{record}/edit'),
        ];
    }
}
