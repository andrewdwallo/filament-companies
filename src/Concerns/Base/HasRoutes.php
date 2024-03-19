<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

use App\Models\CompanyInvitation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Wallo\FilamentCompanies\Http\Controllers\CompanyInvitationController;
use Wallo\FilamentCompanies\Http\Controllers\OAuthController;
use Wallo\FilamentCompanies\Pages\Auth\PrivacyPolicy;
use Wallo\FilamentCompanies\Pages\Auth\Terms;

trait HasRoutes
{
    /**
     * Indicates if Company routes will be registered.
     */
    public static bool $registersRoutes = true;

    /**
     * Configure Company to not register its routes.
     */
    public function ignoreRoutes(): static
    {
        static::$registersRoutes = false;

        return $this;
    }

    protected function registerPublicRoutes(): void
    {
        if (static::hasSocialiteFeatures()) {
            Route::get('/oauth/{provider}', [OAuthController::class, 'redirectToProvider'])->name('oauth.redirect');
            Route::get('/oauth/{provider}/callback', [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');
        }

        if (static::hasTermsAndPrivacyPolicyFeature()) {
            Route::get(Terms::getSlug(), Terms::class)->name(Terms::getRouteName());
            Route::get(PrivacyPolicy::getSlug(), PrivacyPolicy::class)->name(PrivacyPolicy::getRouteName());
        }
    }

    protected function registerAuthenticatedRoutes(): void
    {
        if (static::sendsCompanyInvitations()) {
            Route::get('/invitations/{invitation}', [CompanyInvitationController::class, 'accept'])
                ->middleware(['signed'])
                ->name('invitations.accept');
        }
    }

    public static function route(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        return route(static::generateRouteName($name), $parameters, $absolute);
    }

    public static function generateRouteName(string $name): string
    {
        return 'filament.' . static::getCompanyPanel() . ".{$name}";
    }

    public static function generateOAuthRedirectUrl(string $provider): string
    {
        return static::route('oauth.redirect', compact('provider'));
    }

    public static function generateAcceptInvitationUrl(CompanyInvitation $invitation): string
    {
        return URL::signedRoute(static::generateRouteName('invitations.accept'), compact('invitation'));
    }
}
