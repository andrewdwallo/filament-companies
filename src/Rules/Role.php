<?php

namespace Wallo\FilamentTenants\Rules;

use Illuminate\Contracts\Validation\Rule;
use Wallo\FilamentTenants\FilamentTenants;

class Role implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {
        return array_key_exists($value, FilamentTenants::$roles);
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return __('filament-tenants::default.errors.valid_role');
    }
}
