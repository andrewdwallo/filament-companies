<div class="mt-6 filament-companies-socialite">
    <div class="filament-companies-socialite-divider flex flex-row items-center justify-between py-4 text-gray-900 dark:text-white">
        <hr class="w-full mr-2">
        {{ __('filament-companies::default.subheadings.auth.login') }}
        <hr class="w-full ml-2">
    </div>

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
    @endphp

    <div class="filament-companies-socialite-button-container mt-6 flex flex-wrap items-center justify-center gap-6">
        @foreach ($providers as $iconKey => $provider)
            @php
                $icon = $iconKey === 'twitter-oauth-2' ? 'twitter' : $iconKey;
            @endphp
            @if ($provider['method'])
                <a href="{{ route('filament.company.oauth.redirect', ['provider' => $iconKey]) }}"
                   class="filament-companies-socialite-buttons inline-flex rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:focus:border-primary-500 py-2 px-4 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">{{ $provider['name'] }}</span>
                    <div class="h-6 w-6">
                        @component("filament-companies::components.socialite-icons.{$icon}")@endcomponent
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</div>

