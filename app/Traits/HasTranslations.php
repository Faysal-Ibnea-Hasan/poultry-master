<?php

namespace App\Traits;

use App\Models\Translation;

trait HasTranslations
{
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    public function getTranslation($key, $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $fallbackLocale = config('app.fallback_locale');

        // Try current locale
        $trans = $this->translations
            ->firstWhere(fn($t) => $t->key === $key && $t->locale === $locale);

        if ($trans?->value) {
            return $trans->value;
        }

        // Try fallback locale
        if ($locale !== $fallbackLocale) {
            $trans = $this->translations
                ->firstWhere(fn($t) => $t->key === $key && $t->locale === $fallbackLocale);

            if ($trans?->value) {
                return $trans->value;
            }
        }

        // Final fallback: return raw DB column (without calling the accessor!)
        return $this->getAttributes()[$key] ?? null;
    }


    public function setTranslation(string $key, array $translations)
    {
        foreach ($translations as $locale => $value) {
            if (is_null($value)) {
                continue; // 🚫 Skip null values to avoid DB error
            }
            Translation::updateOrCreate(
                [
                    'translatable_type' => static::class,
                    'translatable_id' => $this->id,
                    'key' => $key,
                    'locale' => $locale,
                ],
                ['value' => $value]
            );
        }
    }

    public function getTranslatedAttribute($key)
    {
        return $this->getTranslation($key);
    }
}
