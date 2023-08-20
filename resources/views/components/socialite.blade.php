<div class="mt-6 filament-companies-socialite">
    <div class="filament-companies-socialite-divider flex flex-row items-center justify-between py-4 text-gray-900 dark:text-white">
        <hr class="w-full mr-2">
        {{ __('filament-companies::default.subheadings.auth.login') }}
        <hr class="w-full ml-2">
    </div>

    <div class="filament-companies-socialite-button-container mt-6 flex flex-wrap items-center justify-center gap-6">
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
                // Add other providers if needed
            ];
        @endphp

        @foreach ($providers as $icon => $provider)
            @if (Wallo\FilamentCompanies\Providers::{$provider['method']}())
                <a href="{{ route('filament.company.oauth.redirect', ['provider' => $icon]) }}"
                   class="filament-companies-socialite-buttons inline-flex rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:focus:border-primary-500 py-2 px-4 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">{{ ucfirst($icon) }}</span>
                    <div class="h-6 w-6">
                        @component("filament-companies::components.socialite-icons.{$icon}")@endcomponent
                    </div>
                </a>
            @endif
        @endforeach
    </div>
</div>
