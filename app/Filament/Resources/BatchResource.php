<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BatchResource\Pages;
use App\Filament\Resources\BatchResource\RelationManagers;
use App\Models\Batch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BatchResource extends Resource
{
    protected static ?string $model = Batch::class;

    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-check';
    protected static ?int $navigationSort = 5; // Position in the navigation bar (lower = higher priority)

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('breed_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('batch_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('arrival_date')
                    ->required(),
                Forms\Components\TextInput::make('initial_weight')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('cost_per_chick')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('source_supplier')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('shed_number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\DatePicker::make('expected_finish_date'),
                Forms\Components\DatePicker::make('actual_finish_date'),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
    public static function getNavigationGroup(): ?string
    {
        return 'Test';
    }
    public static function shouldRegisterNavigation(): bool // Hide or show in navigation
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('breed_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('batch_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('arrival_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('initial_weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost_per_chick')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('source_supplier')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shed_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('expected_finish_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('actual_finish_date')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListBatches::route('/'),
            'create' => Pages\CreateBatch::route('/create'),
            'view' => Pages\ViewBatch::route('/{record}'),
            'edit' => Pages\EditBatch::route('/{record}/edit'),
        ];
    }
}
