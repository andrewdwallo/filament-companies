<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use Wallo\FilamentCompanies\Features;
use Wallo\FilamentCompanies\Http\Controllers\CompanyInvitationController;
use Wallo\FilamentCompanies\Http\Controllers\OAuthController;
use Wallo\FilamentCompanies\Pages\Auth\PrivacyPolicy;
use Wallo\FilamentCompanies\Pages\Auth\Terms;
use Wallo\FilamentCompanies\Socialite;

Route::name('filament.')
    ->group(static function () {
        foreach (Filament::getPanels() as $panel) {
            $hasPlugin = $panel->hasPlugin('companies');

            if (!$hasPlugin) {
                continue;
            }

            $panelId = $panel->getId();
            $domains = $panel->getDomains();
            $hasTenancy = $panel->hasTenancy();
            $plugin = $panel->getPlugin('companies');

            foreach ((empty($domains) ? [null] : $domains) as $domain) {
                Route::domain($domain)
                    ->middleware($panel->getMiddleware())
                    ->name("{$panelId}.")
                    ->prefix($panel->getPath())
                    ->group(static function () use ($plugin, $hasTenancy) {
                        $oauth_route = '/oauth/{provider}';
                        $oauth_callback_route = '/oauth/{provider}/callback';

                        if (Socialite::hasSocialiteFeatures() && $plugin->socialite()) {
                            Route::get($oauth_route, [OAuthController::class, 'redirectToProvider'])->name('oauth.redirect');
                            Route::get($oauth_callback_route, [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');
                        }

                        if (Features::hasTermsAndPrivacyPolicyFeature() && $plugin->termsAndPrivacyPolicy()) {
                            Route::get(Terms::getSlug(), Terms::class)->name(Terms::getRouteName());
                            Route::get(PrivacyPolicy::getSlug(), PrivacyPolicy::class)->name(PrivacyPolicy::getRouteName());
                        }

                        $company_invitations_route = '/company-invitations/{invitation}';

                        // Companies...
                        if (Features::hasCompanyFeatures() && $plugin->companies(invitations: true)) {
                            Route::get($company_invitations_route, [CompanyInvitationController::class, 'accept'])
                                ->middleware(['signed'])
                                ->name('company-invitations.accept');
                        }
                    });
            }
        }
    });
