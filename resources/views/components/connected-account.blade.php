@props(['provider', 'createdAt' => null])

@php
    $providers = [
        Wallo\FilamentCompanies\Providers::facebook() => 'Facebook',
        Wallo\FilamentCompanies\Providers::twitterOAuth1() => 'Twitter',
        Wallo\FilamentCompanies\Providers::twitterOAuth2() => 'Twitter',
        Wallo\FilamentCompanies\Providers::github() => 'GitHub',
        Wallo\FilamentCompanies\Providers::google() => 'Google',
        Wallo\FilamentCompanies\Providers::linkedin() => 'LinkedIn',
        Wallo\FilamentCompanies\Providers::gitlab() => 'GitLab',
        Wallo\FilamentCompanies\Providers::bitbucket() => 'Bitbucket'
    ];
    $name = $providers[$provider] ?? '';
    $icon = strtolower($name);
@endphp

<div>
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <div class="h-6 w-6">
                @if (array_key_exists($provider, $providers))
                    @component("filament-companies::components.socialite-icons.{$icon}") @endcomponent
                @endif
            </div>

            <div class="font-semibold">
                <div class="text-sm text-gray-800 dark:text-gray-200">
                    @if (array_key_exists($provider, $providers))
                        {{ __(ucfirst($name)) }}
                    @endif
                </div>

                @if (! empty($createdAt))
                    <div class="text-xs text-primary-700 dark:text-primary-500">
                        {{  __('filament-companies::default.labels.connected') }}

                        <div class="text-xs text-gray-600 dark:text-gray-300">
                            {{ $createdAt }}
                        </div>
                    </div>
                @else
                    <div class="text-xs text-gray-400">
                        {{ __('filament-companies::default.labels.not_connected') }}
                    </div>
                @endif
            </div>
        </div>

        <div>
            {{ $action }}
        </div>
    </div>

    @error($provider.'_connect_error')
    <div class="text-sm font-semibold text-danger-500 px-3 mt-2">
        {{ $message }}
    </div>
    @enderror
</div>
