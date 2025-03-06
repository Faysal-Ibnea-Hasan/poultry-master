<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatchResource\Pages;
use App\Filament\Resources\PatchResource\RelationManagers;
use App\Models\DesignType;
use App\Models\Patch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatchResource extends Resource
{
    protected static ?string $model = Patch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('design_type_id')
                    ->options(fn() => DesignType::pluck('type', 'id'))
                    ->label('Design Type')
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->default(function () {
                        $lastPatch = \App\Models\Patch::latest('id')->first();
                        $lastNumber = $lastPatch ? intval(substr($lastPatch->code, 2)) : 0;
                        return 'P-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                    })
                    ->disabled()
                    ->dehydrated() // Still saves in the database
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('content_type')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('order')
                    ->unique('patches', 'order', ignoreRecord: true)
                    ->label('Order')
                    ->default(fn() => Patch::max('order') + 1) // Auto-increment order
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('designType.type')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                // ✅ Toggle for 'status' field
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status')
                    ->onColor('success')
                    ->sortable()
                    ->afterStateUpdated(fn($record) => Notification::make()
                        ->title('Status Updated')
                        ->body("The status is now " . ($record->status ? 'Published' : 'Draft'))
                        ->success()
                        ->send()
                    ),
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
                Action::make('assignPatch')
                    ->label('Assign to Patch')
                    ->icon('heroicon-s-plus-circle')
                    ->url(fn($record) => OptionPatchResource::getUrl('create', [
                        'patch_id' => $record->id,
                    ])) // Pass design_type_id to create page
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
