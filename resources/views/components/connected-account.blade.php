@props(['provider', 'createdAt' => null])

@php
    $providerEnum = \Wallo\FilamentTenants\Enums\Provider::tryFrom($provider);
@endphp

@if($providerEnum?->isEnabled())
    <div class="filament-tenants-connected-account">
        <div class="filament-tenants-connected-account-container flex items-center justify-between">
            <div class="filament-tenants-connected-account-details flex items-center gap-x-2">
                <div class="filament-tenants-connected-account-icon h-8 w-8">
                    {{ $providerEnum->getIconView() }}
                </div>

                <div class="filament-tenants-connected-account-info font-semibold">
                    <div class="filament-tenants-connected-account-name text-sm text-gray-800 dark:text-gray-200">
                        {{ $providerEnum->getLabel() }}
                    </div>

                    @if (!empty($createdAt))
                        <div
                            class="filament-tenants-connected-account-connected text-xs text-primary-700 dark:text-primary-500">
                            {{ __('filament-tenants::default.labels.connected') }}
                            <div
                                class="filament-tenants-connected-account-connected-date text-xs text-gray-600 dark:text-gray-300">
                                {{ $createdAt }}
                            </div>
                        </div>
                    @else
                        <div class="filament-tenants-connected-account-not-connected text-xs text-gray-400">
                            {{ __('filament-tenants::default.labels.not_connected') }}
                        </div>
                    @endif
                </div>
            </div>

            <div>
                {{ $action }}
            </div>
        </div>

        @error($provider.'_connect_error')
        <div class="filament-tenants-connected-account-error text-sm font-semibold text-danger-500 px-3 mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>
@endif
