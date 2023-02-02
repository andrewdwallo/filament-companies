@props(['provider', 'createdAt' => null])

<div>
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <div class="pr-2">
                @switch($provider)
                    @case(Wallo\FilamentCompanies\Providers::facebook())
                        <x-filament-companies::socialite-icons.facebook />
                        @break
                    @case(Wallo\FilamentCompanies\Providers::google())
                        <x-filament-companies::socialite-icons.google />
                        @break
                    @case(Wallo\FilamentCompanies\Providers::twitter())
                    @case(Wallo\FilamentCompanies\Providers::twitterOAuth1())
                    @case(Wallo\FilamentCompanies\Providers::twitterOAuth2())
                        <x-filament-companies::socialite-icons.twitter />
                        @break
                    @case(Wallo\FilamentCompanies\Providers::linkedin())
                        <x-filament-companies::socialite-icons.linkedin />
                        @break
                    @case(Wallo\FilamentCompanies\Providers::github())
                        <x-filament-companies::socialite-icons.github />
                        @break
                    @case(Wallo\FilamentCompanies\Providers::gitlab())
                        <x-filament-companies::socialite-icons.gitlab />
                        @break
                    @case(Wallo\FilamentCompanies\Providers::bitbucket())
                        <x-filament-companies::socialite-icons.bitbucket />
                        @break
                    @default
                @endswitch
            </div>

            <div>
                <div class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                    {{ __(ucfirst($provider)) }}
                </div>

                @if (! empty($createdAt))
                    <div class="text-xs font-semibold text-primary-500">
                        {{  __('filament-companies::default.labels.connected') }} {{ $createdAt }}
                    </div>
                @else
                    <div class="text-xs font-semibold text-primary-500">
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
    <div class="text-sm font-semibold text-red-500 px-3 mt-2">
        {{ $message }}
    </div>
    @enderror
</div>
