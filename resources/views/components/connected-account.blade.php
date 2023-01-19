@props(['provider', 'createdAt' => null])

<div>
    <div class="pl-3 flex items-center justify-between">
        <div class="flex items-center">
            @switch($provider)
                @case(Wallo\FilamentCompanies\Providers::facebook())
                    <x-filament-companies::socialite-icons.facebook class="h-6 w-6 mr-2" />
                    @break
                @case(Wallo\FilamentCompanies\Providers::google())
                    <x-filament-companies::socialite-icons.google class="h-6 w-6 mr-2" />
                    @break
                @case(Wallo\FilamentCompanies\Providers::twitter())
                @case(Wallo\FilamentCompanies\Providers::twitterOAuth1())
                @case(Wallo\FilamentCompanies\Providers::twitterOAuth2())
                    <x-filament-companies::socialite-icons.twitter class="h-6 w-6 mr-2" />
                    @break
                @case(Wallo\FilamentCompanies\Providers::linkedin())
                    <x-filament-companies::socialite-icons.linkedin class="h-6 w-6 mr-2" />
                    @break
                @case(Wallo\FilamentCompanies\Providers::github())
                    <x-filament-companies::socialite-icons.github class="h-6 w-6 mr-2" />
                    @break
                @case(Wallo\FilamentCompanies\Providers::gitlab())
                    <x-filament-companies::socialite-icons.gitlab class="h-6 w-6 mr-2" />
                    @break
                @case(Wallo\FilamentCompanies\Providers::bitbucket())
                    <x-filament-companies::socialite-icons.bitbucket class="h-6 w-6 mr-2" />
                    @break
                @default
            @endswitch

            <div>
                <div class="text-sm font-semibold text-gray-600">
                    {{ __(ucfirst($provider)) }}
                </div>

                @if (! empty($createdAt))
                    <div class="text-xs text-gray-500">
                        Connected {{ $createdAt }}
                    </div>
                @else
                    <div class="text-xs text-gray-500">
                        {{ __('Not connected.') }}
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
