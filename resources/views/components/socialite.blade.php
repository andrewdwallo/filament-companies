<div class="flex flex-row items-center justify-between py-4 text-gray-500">
    <hr class="w-full mr-2">
    {{ __('filament-companies::default.subheadings.auth.login') }}
    <hr class="w-full ml-2">
</div>

<div class="flex items-center justify-center">
    @if (Wallo\FilamentCompanies\Socialite::hasFacebookSupport())
        <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::facebook()]) }}">
            <x-filament-companies::socialite-icons.facebook class="h-6 w-6 mx-2" />
            <span class="sr-only">Facebook</span>
        </a>
    @endif

    @if (Wallo\FilamentCompanies\Socialite::hasGoogleSupport())
        <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::google()]) }}" >
            <x-filament-companies::socialite-icons.google class="h-6 w-6 mx-2" />
            <span class="sr-only">Google</span>
        </a>
    @endif

    @if (Wallo\FilamentCompanies\Socialite::hasTwitterOAuth1Support())
        <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::twitter()]) }}">
            <x-filament-companies::socialite-icons.twitter class="h-6 w-6 mx-2" />
            <span class="sr-only">Twitter</span>
        </a>
    @endif

    @if (Wallo\FilamentCompanies\Socialite::hasTwitterOAuth2Support())
        <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::twitterOAuth2()]) }}">
            <x-filament-companies::socialite-icons.twitter class="h-6 w-6 mx-2" />
            <span class="sr-only">Twitter</span>
        </a>
    @endif

    @if (Wallo\FilamentCompanies\Socialite::hasLinkedInSupport())
        <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::linkedin()]) }}">
            <x-filament-companies::socialite-icons.linkedin class="h-6 w-6 mx-2" />
            <span class="sr-only">LinkedIn</span>
        </a>
    @endif

    @if (Wallo\FilamentCompanies\Socialite::hasGithubSupport())
        <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::github()]) }}">
            <x-filament-companies::socialite-icons.github class="h-6 w-6 mx-2" />
            <span class="sr-only">GitHub</span>
        </a>
    @endif

    @if (Wallo\FilamentCompanies\Socialite::hasGitlabSupport())
        <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::gitlab()]) }}">
            <x-filament-companies::socialite-icons.gitlab class="h-6 w-6 mx-2" />
            <span class="sr-only">GitLab</span>
        </a>
    @endif

    @if (Wallo\FilamentCompanies\Socialite::hasBitbucketSupport())
        <a href="{{ route('oauth.redirect', ['provider' => Wallo\FilamentCompanies\Providers::bitbucket()]) }}">
            <x-filament-companies::socialite-icons.bitbucket />
            <span class="sr-only">BitBucket</span>
        </a>
    @endif
</div>
