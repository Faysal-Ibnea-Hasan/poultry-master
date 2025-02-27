<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatchResource\Pages;
use App\Filament\Resources\PatchResource\RelationManagers;
use App\Models\Option;
use App\Models\Patch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatchResource extends Resource
{
    protected static ?string $model = Patch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->default(fn () => 'PATCH-' . strtoupper(uniqid())) // Auto-generate code
                    ->disabled()
                    ->dehydrated() // Still saves in the database
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->maxLength(255),

                Forms\Components\Select::make('option_ids')
                    ->label('Menus')
                    ->options(Option::pluck('name', 'id')) // Fetch all options
                    ->multiple() // Allow selecting multiple options
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $recordId = $get('id'); // Get the current record's ID
                        $existingPatch = Patch::whereJsonContains('option_ids', $state)
                            ->where('id', '!=', $recordId) // Exclude the current record
                            ->first();

                        if ($existingPatch) {
                            $set('option_ids', []); // Clear selection if already exists
                            Notification::make()
                                ->title('Error')
                                ->body('One or more options are already linked to another code!')
                                ->danger()
                                ->send();
                        }
                    }),

                Forms\Components\TextInput::make('order')
                    ->unique('patches','order',ignoreRecord: true)
                    ->label('Order')
                    ->default(fn () => Patch::max('order') + 1) // Auto-increment order
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('option_count')
                    ->label('Menu Count') // Change column label
                    ->getStateUsing(fn (Patch $record) => count($record->option_ids ?? [])) // Count options
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
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
            'index' => Pages\ListPatches::route('/'),
            'create' => Pages\CreatePatch::route('/create'),
            'edit' => Pages\EditPatch::route('/{record}/edit'),
        ];
    }
}
