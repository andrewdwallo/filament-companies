<?php

namespace Wallo\FilamentTenants\Concerns\Base;

use App\Models\TenantInvitation;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Wallo\FilamentTenants\Http\Controllers\TenantInvitationController;
use Wallo\FilamentTenants\Http\Controllers\OAuthController;
use Wallo\FilamentTenants\Pages\Auth\PrivacyPolicy;
use Wallo\FilamentTenants\Pages\Auth\Terms;

trait HasRoutes
{
    /**
     * Indicates if Tenant routes will be registered.
     */
    public static bool $registersRoutes = true;

    /**
     * Configure Tenant to not register its routes.
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
        if (static::sendsTenantInvitations()) {
            Route::get('/invitations/{invitation}', [TenantInvitationController::class, 'accept'])
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
        return 'filament.' . static::getTenantPanel() . ".{$name}";
    }

    public static function generateOAuthRedirectUrl(string $provider): string
    {
        return static::route('oauth.redirect', compact('provider'));
    }

    public static function generateAcceptInvitationUrl(TenantInvitation $invitation): string
    {
        return URL::signedRoute(static::generateRouteName('invitations.accept'), compact('invitation'));
    }
}
