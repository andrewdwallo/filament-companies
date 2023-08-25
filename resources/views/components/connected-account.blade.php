@props(['provider', 'createdAt' => null])

@php
    use Wallo\FilamentCompanies\Providers;

    $providers = [
        Providers::github() => ['method' => Providers::hasGithub(), 'name' => 'GitHub'],
        Providers::gitlab() => ['method' => Providers::hasGitlab(), 'name' => 'GitLab'],
        Providers::google() => ['method' => Providers::hasGoogle(), 'name' => 'Google'],
        Providers::facebook() => ['method' => Providers::hasFacebook(), 'name' => 'Facebook'],
        Providers::linkedin() => ['method' => Providers::hasLinkedIn(), 'name' => 'LinkedIn'],
        Providers::bitbucket() => ['method' => Providers::hasBitbucket(), 'name' => 'Bitbucket'],
        Providers::twitter() => ['method' => Providers::hasTwitter(), 'name' => 'Twitter'],
        Providers::twitterOAuth2() => ['method' => Providers::hasTwitterOAuth2(), 'name' => 'Twitter'],
    ];

    $icon = $provider === Providers::twitterOAuth2() ? Providers::twitter() : $provider;
    $name = $providers[$provider]['name'];
@endphp

@if($providers[$provider]['method'])
    <div class="filament-companies-connected-account">
        <div class="filament-companies-connected-account-container flex items-center justify-between">
            <div class="filament-companies-connected-account-details flex items-center gap-x-2">
                <div class="filament-companies-connected-account-icon h-8 w-8">
                    @component("filament-companies::components.socialite-icons.{$icon}") @endcomponent
                </div>

                <div class="filament-companies-connected-account-info font-semibold">
                    <div class="filament-companies-connected-account-name text-sm text-gray-800 dark:text-gray-200">
                        {{ __($name) }}
                    </div>

                    @if (!empty($createdAt))
                        <div
                            class="filament-companies-connected-account-connected text-xs text-primary-700 dark:text-primary-500">
                            {{ __('filament-companies::default.labels.connected') }}
                            <div
                                class="filament-companies-connected-account-connected-date text-xs text-gray-600 dark:text-gray-300">
                                {{ $createdAt }}
                            </div>
                        </div>
                    @else
                        <div class="filament-companies-connected-account-not-connected text-xs text-gray-400">
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
        <div class="filament-companies-connected-account-error text-sm font-semibold text-danger-500 px-3 mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>
@endif
