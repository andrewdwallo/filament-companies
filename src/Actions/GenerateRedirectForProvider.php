<?php

namespace Wallo\FilamentCompanies\Actions;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Wallo\FilamentCompanies\Contracts\GeneratesProviderRedirect;
use Laravel\Socialite\Facades\Socialite;

class GenerateRedirectForProvider implements GeneratesProviderRedirect
{
    /**
     * Generates the redirect for a given provider.
     *
     * @param  string  $provider
     * @return RedirectResponse
     */
    public function generate(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }
}
