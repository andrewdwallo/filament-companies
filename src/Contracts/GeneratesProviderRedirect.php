<?php

namespace Wallo\FilamentCompanies\Contracts;

use Symfony\Component\HttpFoundation\RedirectResponse;

interface GeneratesProviderRedirect
{
    /**
     * Generates the redirect for a given provider.
     *
     * @param  string  $provider
     * @return RedirectResponse
     */
    public function generate(string $provider): RedirectResponse;
}
