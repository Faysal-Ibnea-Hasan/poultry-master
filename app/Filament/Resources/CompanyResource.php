<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-office-2';
    protected static ?string $navigationGroup = 'Menu';

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
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
//                Forms\Components\TextInput::make('contact_person')
//                    ->maxLength(255)
//                    ->default(null),
//                Forms\Components\TextInput::make('phone')
//                    ->tel()
//                    ->maxLength(255)
//                    ->default(null),
//                Forms\Components\TextInput::make('email')
//                    ->email()
//                    ->maxLength(255)
//                    ->default(null),
//                Forms\Components\TextInput::make('logo')
//                    ->maxLength(255)
//                    ->default(null),
//                Forms\Components\TextInput::make('registration_number')
//                    ->maxLength(255)
//                    ->default(null),
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
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
//                Tables\Columns\TextColumn::make('phone')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('email')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('logo')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('registration_number')
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
