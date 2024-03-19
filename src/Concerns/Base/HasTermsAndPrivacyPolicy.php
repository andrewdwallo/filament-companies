<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

use Closure;
use Illuminate\Support\Arr;

trait HasTermsAndPrivacyPolicy
{
    /**
     * Determine if the application is using the terms confirmation feature.
     */
    public static bool $hasTermsAndPrivacyPolicyFeature = false;

    /**
     * Determine if the application is using the terms confirmation feature.
     */
    public function termsAndPrivacyPolicy(bool | Closure | null $condition = true): static
    {
        static::$hasTermsAndPrivacyPolicyFeature = $condition instanceof Closure ? $condition() : $condition;

        return $this;
    }

    /**
     * Determine if the application is using the terms confirmation feature.
     */
    public static function hasTermsAndPrivacyPolicyFeature(): bool
    {
        return static::$hasTermsAndPrivacyPolicyFeature;
    }

    /**
     * Find the path to a localized Markdown resource.
     */
    public static function localizedMarkdownPath(string $name): ?string
    {
        $localName = preg_replace('#(\.md)$#i', '.' . app()->getLocale() . '$1', $name);

        return Arr::first([
            resource_path('markdown/' . $localName),
            resource_path('markdown/' . $name),
        ], static function ($path) {
            return file_exists($path);
        });
    }
}
