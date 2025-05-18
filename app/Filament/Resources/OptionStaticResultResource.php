<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionStaticResultResource\Pages;
use App\Filament\Resources\OptionStaticResultResource\RelationManagers;
use App\Models\Option;
use App\Models\OptionStaticResult;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OptionStaticResultResource extends Resource
{
    protected static ?string $model = OptionStaticResult::class;

    protected static ?string $navigationIcon = 'heroicon-s-numbered-list';
    protected static ?string $navigationGroup = 'Menu';
    protected static ?string $navigationLabel = 'Static Results';
    protected static ?string $breadcrumb = 'Static Results';

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
                                    Forms\Components\TextInput::make("translations.{$locale}.title")
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make("translations.{$locale}.sub_title")
                                        ->maxLength(255),
                                    FileUpload::make("translations.{$locale}.file")
                                        ->label('Image')
                                        ->disk('public')
                                        ->visibility('public')
                                        ->nullable(),
                                ])->columns(1);
                        })->toArray()
                    ),
                Forms\Components\Select::make('option_id')
                    ->label('Menu')
                    ->options(fn() => Option::pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('option.name')
                    ->label('Menu')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sub_title')
                    ->searchable(),
//                ImageColumn::make('file')
//                    ->disk('public')
//                    ->label('Image')
//                    ->size(50),
                TextColumn::make('file')
                    ->label('File')
                    ->formatStateUsing(fn ($state) =>
                    pathinfo($state, PATHINFO_EXTENSION) === 'pdf'
                        ? '<a href="' . asset('storage/' . $state) . '" target="_blank" class="text-primary">Download PDF</a>'
                        : '<img src="' . asset('storage/' . $state) . '" alt="Image" style="width:50px; height:50px; border-radius:5px;">'
                    )
                    ->html(),
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
            'index' => Pages\ListOptionStaticResults::route('/'),
            'create' => Pages\CreateOptionStaticResult::route('/create'),
            'edit' => Pages\EditOptionStaticResult::route('/{record}/edit'),
        ];
    }
}
