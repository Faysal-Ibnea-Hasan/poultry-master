<?php

namespace App\Filament\Resources\SubscriptionResource\Pages;

use App\Filament\Resources\SubscriptionResource;
use App\Models\ChickType;
use App\Models\Subscription;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscription extends CreateRecord
{
    protected static string $resource = SubscriptionResource::class;
    protected function handleRecordCreation(array $data): Subscription
    {
        $translations = $data['translations'] ?? [];
        unset($data['translations']);

        // ✅ Use default locale for main table field
        $defaultLocale = app()->getLocale(); // Or use config('app.locale')
        $data['plan_name'] = $translations[$defaultLocale]['plan_name'] ?? null;

        $subscription = Subscription::create($data);

        // ✅ Save all translations including default
        foreach ($translations as $locale => $fields) {
            foreach ($fields as $key => $value) {
                $subscription->setTranslation($key, [$locale => $value]);
            }
        }

        return $subscription;
    }
}
