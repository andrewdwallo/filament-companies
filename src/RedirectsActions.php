<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

trait RedirectsActions
{
    /**
     * Get the redirect response for the given action.
     */
    public function redirectPath(mixed $action): Response | Redirector | RedirectResponse
    {
        if (method_exists($action, 'redirectTo')) {
            $response = $action->redirectTo();
        } else {
            $response = property_exists($action, 'redirectTo')
                ? $action->redirectTo
                : filament()->getHomeUrl();
        }

        return $response instanceof Response ? $response : redirect($response);
    }
}
