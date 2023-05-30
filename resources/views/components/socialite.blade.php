<div class="mt-6 filament-companies-socialite">
    <div class="filament-companies-socialite-divider flex flex-row items-center justify-between py-4 text-gray-900 dark:text-white">
        <hr class="w-full mr-2">
        {{ __('filament-companies::default.subheadings.auth.login') }}
        <hr class="w-full ml-2">
    </div>

    <div class="filament-companies-socialite-button-container mt-6 flex flex-wrap items-center justify-center gap-6">
        @php
            $providers = [
                'Facebook' => ['provider' => Wallo\FilamentCompanies\Providers::facebook(), 'method' => 'hasFacebook'],
                'TwitterOAuth1' => ['provider' => Wallo\FilamentCompanies\Providers::twitterOAuth1(), 'method' => 'hasTwitterOAuth1'],
                'GitHub' => ['provider' => Wallo\FilamentCompanies\Providers::github(), 'method' => 'hasGithub'],
                'Google' => ['provider' => Wallo\FilamentCompanies\Providers::google(), 'method' => 'hasGoogle'],
                'TwitterOAuth2' => ['provider' => Wallo\FilamentCompanies\Providers::twitterOAuth2(), 'method' => 'hasTwitterOAuth2'],
                'LinkedIn' => ['provider' => Wallo\FilamentCompanies\Providers::linkedin(), 'method' => 'hasLinkedIn'],
                'GitLab' => ['provider' => Wallo\FilamentCompanies\Providers::gitlab(), 'method' => 'hasGitlab'],
                'Bitbucket' => ['provider' => Wallo\FilamentCompanies\Providers::bitbucket(), 'method' => 'hasBitbucket'],
            ];
        @endphp

        @foreach ($providers as $name => $provider)
            @if (call_user_func([Wallo\FilamentCompanies\Socialite::class, $provider['method']]))
                <a href="{{ route('oauth.redirect', ['provider' => $provider['provider']]) }}"
                   class="filament-companies-socialite-buttons inline-flex rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:focus:border-primary-500 py-2 px-4 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    @php
                        $name = str_replace(array('OAuth2', 'OAuth1'), '', $name);
                        $icon = strtolower($name);
                    @endphp
                    <span class="sr-only">{{ $name }}</span>
                    <div class="h-6 w-6">
                        @component("filament-companies::components.socialite-icons.{$icon}")@endcomponent
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</div>
