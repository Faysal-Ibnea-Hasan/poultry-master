<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionPatchResource\Pages;
use App\Filament\Resources\OptionPatchResource\RelationManagers;
use App\Models\Option;
use App\Models\OptionPatch;
use App\Models\Patch;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ButtonAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OptionPatchResource extends Resource
{
    protected static ?string $model = OptionPatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $breadcrumb = 'Patches';

    public static function form(Form $form): Form
    {
        // Get the patch_id from the query string
        $patchId = request()->query('patch_id');
        $patch = $patchId ? Patch::find($patchId) : null;
        $designTypeId = $patch?->design_type_id;

        // Check if we're in an edit context (if options are already assigned to the patch)
        $isEdit = $patchId && $patch; // If a patch_id is provided and a patch exists

        return $form
            ->schema([
                // Pre-selected and disabled Patch
                Select::make('patch_id')
                    ->label('Patch')
                    ->options(Patch::pluck('code', 'id'))
                    ->default($patchId) // Pre-select the patch in both create and edit
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                // Disabled Design Type (Not saved to database)
                TextInput::make('design_type')
                    ->label('Design Type')
                    ->default($patch?->designType->type) // Pre-fill if editing
                    ->disabled()
                    ->dehydrated(false), // Won't be saved in the database

                // Multi-select Options (Filtered by design type)
                Select::make('option_ids')
                    ->label('Options')
                    ->options(fn (callable $get) =>
                    Option::where('design_type_id', $get('design_type_id'))->pluck('name', 'id')
                    )
                    ->reactive()  // Dynamically update when the design_type_id changes
                    ->multiple()  // Allow selecting multiple options
                    ->searchable() // Allow searching the options
                    ->default($isEdit ? $patch->options->pluck('id')->toArray() : []),  // Pre-fill selected options if editing

                // Hidden field to store design_type_id (used in option filtering)
                TextInput::make('design_type_id')
                    ->default($designTypeId)  // Set design_type_id when editing
                    ->hidden()
                    ->dehydrated(),
            ]);

    }
    public static function shouldRegisterNavigation(): bool // Hide or show in navigation
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListOptionPatches::route('/'),
            'create' => Pages\CreateOptionPatch::route('/create'),
            'edit' => Pages\EditOptionPatch::route('/{record}/edit'),
        ];
    }
}
