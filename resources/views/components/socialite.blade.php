<div class="mt-6">
    <div class="flex flex-row items-center justify-between py-4 text-gray-900 dark:text-white">
        <hr class="w-full mr-2">
        {{ __('filament-companies::default.subheadings.auth.login') }}
        <hr class="w-full ml-2">
    </div>

    <div class="mt-6 flex items-center justify-center">
        <div>
            @if (Wallo\FilamentCompanies\Socialite::hasFacebook())
                <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::facebook()]) }}" class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">Facebook</span>
                    <x-filament-companies::socialite-icons.facebook />
                </a>
            @endif
        </div>

        <div>
            @if (Wallo\FilamentCompanies\Socialite::hasTwitterOAuth1())
                <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::twitterOAuth1()]) }}" class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">Twitter</span>
                    <x-filament-companies::socialite-icons.twitter />
                </a>
            @endif
        </div>

        <div>
            @if (Wallo\FilamentCompanies\Socialite::hasGithub())
                <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::github()]) }}" class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">GitHub</span>
                    <x-filament-companies::socialite-icons.github />
                </a>
            @endif
        </div>

        <div>
            @if (Wallo\FilamentCompanies\Socialite::hasGoogle())
                <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::google()]) }}" class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">Google</span>
                    <x-filament-companies::socialite-icons.google />
                </a>
            @endif
        </div>

        <div>
            @if (Wallo\FilamentCompanies\Socialite::hasTwitterOAuth2())
                <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::twitterOAuth2()]) }}" class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">Twitter</span>
                    <x-filament-companies::socialite-icons.twitter />
                </a>
            @endif
        </div>

        <div>
            @if (Wallo\FilamentCompanies\Socialite::hasLinkedIn())
                <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::linkedin()]) }}" class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">LinkedIn</span>
                    <x-filament-companies::socialite-icons.linkedin />
                </a>
            @endif
        </div>

        <div>
            @if (Wallo\FilamentCompanies\Socialite::hasGitlab())
                <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::gitlab()]) }}" class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">GitLab</span>
                    <x-filament-companies::socialite-icons.gitlab />
                </a>
            @endif
        </div>

        <div>
            @if (Wallo\FilamentCompanies\Socialite::hasBitbucket())
                <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::bitbucket()]) }}" class="inline-flex w-full justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 py-2 px-4 text-sm font-medium text-gray-500 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600">
                    <span class="sr-only">BitBucket</span>
                    <x-filament-companies::socialite-icons.bitbucket />
                </a>
            @endif
        </div>
    </div>
</div>
