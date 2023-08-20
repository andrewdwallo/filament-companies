@props(['provider', 'createdAt' => null])

@php
    $providers = [
        'facebook' => ['method' => 'hasFacebook'],
        'twitter' => ['method' => 'hasTwitterOAuth1'],
        'twitter' => ['method' => 'hasTwitterOAuth2'],
        'github' => ['method' => 'hasGithub'],
        'google' => ['method' => 'hasGoogle'],
        'linkedin' => ['method' => 'hasLinkedIn'],
        'gitlab' => ['method' => 'hasGitlab'],
        'bitbucket' => ['method' => 'hasBitbucket'],
    ];
@endphp

@foreach($providers as $icon => $provider)
    @if(Wallo\FilamentCompanies\Providers::{$provider['method']}())
        <div class="filament-companies-connected-account">
            <div class="filament-companies-connected-account-container flex items-center justify-between">
                <div class="filament-companies-connected-account-details flex items-center gap-x-2">
                    <div class="filament-companies-connected-account-icon h-8 w-8">
                        @component("filament-companies::components.socialite-icons.{$icon}") @endcomponent
                    </div>

                    <div class="filament-companies-connected-account-info font-semibold">
                        <div class="filament-companies-connected-account-name text-sm text-gray-800 dark:text-gray-200">
                            {{ __(ucfirst($icon)) }}
                        </div>

                        @if (!empty($createdAt))
                            <div class="filament-companies-connected-account-connected text-xs text-primary-700 dark:text-primary-500">
                                {{ __('filament-companies::default.labels.connected') }}
                                <div class="filament-companies-connected-account-connected-date text-xs text-gray-600 dark:text-gray-300">
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

            @error($icon.'_connect_error')
            <div class="filament-companies-connected-account-error text-sm font-semibold text-danger-500 px-3 mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>
    @endif
@endforeach
