@props([
    'errorMessage' => null,
])

<div class="mt-6 filament-tenants-socialite">
    <div class="filament-tenants-socialite-divider flex flex-row items-center justify-between py-4 text-gray-900 dark:text-white">
        <hr class="w-full mr-2">
        {{ __('filament-tenants::default.subheadings.auth.login') }}
        <hr class="w-full ml-2">
    </div>

    @if ($errorMessage)
        <div class="mt-6 text-center text-sm text-danger-600 dark:text-danger-500">{!! $errorMessage !!}</div>
    @endif

    <div class="filament-tenants-socialite-button-container mt-6 flex flex-wrap items-center justify-center gap-6">
        @foreach (\Wallo\FilamentTenants\Enums\Provider::cases() as $provider)
            @if ($provider->isEnabled())
                <a href="{{ \Wallo\FilamentTenants\FilamentTenants::generateOAuthRedirectUrl($provider->value) }}"
                   class="filament-tenants-socialite-buttons inline-flex rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:focus:border-primary-500 py-2 px-4 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">{{ $provider->getLabel() }}</span>
                    <div class="h-6 w-6">
                        {{ $provider->getIconView() }}
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</div>

