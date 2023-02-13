<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Http\Response;

trait RedirectsActions
{
    /**
     * Get the redirect response for the given action.
     *
     * @param  mixed  $action
     * @return Response
     */
    public function redirectPath(mixed $action): Response
    {
        if (method_exists($action, 'redirectTo')) {
            $response = $action->redirectTo();
        } else {
            $property = property_exists($action, 'redirectTo');
            $response = $property ? $action->redirectTo : config('fortify.home');
        }

        return $response instanceof Response ? $response : redirect($response);
    }
}
