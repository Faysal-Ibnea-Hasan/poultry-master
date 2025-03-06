<?php

namespace App\Filament\Resources\OptionPatchResource\Pages;

use App\Filament\Resources\OptionPatchResource;
use App\Filament\Resources\PatchResource;
use App\Models\Patch;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOptionPatch extends CreateRecord
{
    protected static string $resource = OptionPatchResource::class;
    protected static ?string $title = 'Assign to patch'; // Updated list page title
    protected static ?string $breadcrumb = 'Assign';

    protected function getHeaderActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Save')
                ->formId('form'),
            Actions\Action::make('Back')
                ->label('Back')
                ->url(PatchResource::getUrl())
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Saved';
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Step 1: Remove any existing options for this patch that are not in the new list
        \App\Models\OptionPatch::where('patch_id', $data['patch_id'])
            ->whereNotIn('option_id', $data['option_ids']) // Remove options not selected
            ->delete();

        // Step 2: Get existing patch-option combinations
        $existingOptions = \App\Models\OptionPatch::where('patch_id', $data['patch_id'])
            ->pluck('option_id')
            ->toArray();

        // Step 3: Filter out options that are already assigned to the patch
        $newOptions = collect($data['option_ids'])->filter(function ($optionId) use ($existingOptions) {
            return !in_array($optionId, $existingOptions); // Only keep new options not already assigned
        });

        // Step 4: Prepare the records for insertion
        $records = $newOptions->map(function ($optionId) use ($data) {
            return [
                'patch_id' => $data['patch_id'],
                'option_id' => $optionId,
                'updated_at' => now(),
            ];
        });

        // Step 5: Insert the new options to the patch
        \App\Models\OptionPatch::insert($records->toArray());

        // Return the first record associated with the given patch_id (or adjust based on your needs)
        return \App\Models\OptionPatch::where('patch_id', $data['patch_id'])->firstOrNew();
    }

    protected function getRedirectUrl(): string
    {
        return PatchResource::getUrl('index'); // Redirect to index page of PatchResource
    }


}
