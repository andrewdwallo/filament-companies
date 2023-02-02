<?php

use Illuminate\Support\Facades\Route;
use Wallo\FilamentCompanies\Http\Controllers\CurrentCompanyController;
use Wallo\FilamentCompanies\Http\Controllers\Livewire\PrivacyPolicyController;
use Wallo\FilamentCompanies\Http\Controllers\Livewire\TermsOfServiceController;
use Wallo\FilamentCompanies\Http\Controllers\CompanyInvitationController;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Http\Controllers\OAuthController;
use Wallo\FilamentCompanies\Pages\Companies\CompanySettings;
use Wallo\FilamentCompanies\Pages\Companies\CreateCompany;
use Wallo\FilamentCompanies\Pages\User\APITokens;
use Wallo\FilamentCompanies\Pages\User\Profile;


Route::group(['middleware' => config('filament-companies.middleware', ['web'])], function () {

    Route::get('/oauth/{provider}', [OAuthController::class, 'redirectToProvider'])->name('oauth.redirect');
    Route::get('/oauth/{provider}/callback', [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');

    if (FilamentCompanies::hasTermsAndPrivacyPolicyFeature()) {
        Route::get('/terms-of-service', [TermsOfServiceController::class, 'show'])->name('terms.show');
        Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');
    }

    $authMiddleware = config('filament-companies.guard')
            ? 'auth:'.config('filament-companies.guard')
            : 'auth';

    $authSessionMiddleware = config('filament-companies.auth_session', false)
            ? config('filament-companies.auth_session')
            : null;


    Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
        // User & Profile...
        Route::prefix(config('filament.path'))
            ->group(function () {
                Route::get('/user/profile', Profile::class);

                Route::group(['middleware' => 'verified'], function () {
                    // API...
                    if (FilamentCompanies::hasApiFeatures()) {
                        Route::get('/user/api-tokens', APITokens::class);
                    }

                    // Companies...
                    if (FilamentCompanies::hasCompanyFeatures()) {
                        Route::get('companies/create', CreateCompany::class);

                        Route::get('companies/{company}', CompanySettings::class);
                        Route::put('/current-company', [CurrentCompanyController::class, 'update'])->name('current-company.update');

                        Route::get('/company-invitations/{invitation}', [CompanyInvitationController::class, 'accept'])
                                    ->middleware(['signed'])
                                    ->name('company-invitations.accept');
                    }
                });
            });
        });
    });
