<?php

namespace Wallo\FilamentCompanies;

use Filament\Contracts\Plugin;
use Filament\Events\TenantSet;
use Filament\Panel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Wallo\FilamentCompanies\Contracts\HandlesInvalidState;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
use Wallo\FilamentCompanies\Http\Controllers\OAuthController;
use Wallo\FilamentCompanies\Listeners\SwitchCurrentCompany;
use Wallo\FilamentCompanies\Pages\Company\CompanySettings;
use Wallo\FilamentCompanies\Pages\Company\CreateCompany;

class FilamentCompanies implements Plugin
{
    use Concerns\ManagesProfileComponents;
    use Concerns\Base\HasBaseActionBindings;
    use Concerns\Base\HasBaseModels;
    use Concerns\Base\HasPermissions;
    use Concerns\Base\HasPanels;
    use Concerns\Base\HasRoutes;
    use Concerns\Base\HasBaseProfileComponents;
    use Concerns\Base\HasBaseProfileFeatures;
    use Concerns\Base\HasCompanyFeatures;
    use Concerns\Base\HasNotifications;
    use Concerns\Base\HasTermsAndPrivacyPolicy;
    use Concerns\Base\HasModals;
    use Concerns\Base\HasAddedProfileComponents;
    use Concerns\Socialite\HasProviders;
    use Concerns\Socialite\HasProviderFeatures;
    use Concerns\Socialite\HasConnectedAccountModel;
    use Concerns\Socialite\HasSocialiteComponents;
    use Concerns\Socialite\HasSocialiteProfileFeatures;
    use Concerns\Socialite\HasSocialiteActionBindings;
    use Concerns\Socialite\CanEnableSocialite;

    public function getId(): string
    {
        return 'companies';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        if (static::hasCompanyFeatures()) {
            Livewire::component('filament.pages.companies.create_company', CreateCompany::class);
            Livewire::component('filament.pages.companies.company_settings', CompanySettings::class);
        }

        if (static::hasSocialiteFeatures()) {
            app()->bind(OAuthController::class, static function (Application $app) {
                return new OAuthController(
                    $app->make(CreatesUserFromProvider::class),
                    $app->make(CreatesConnectedAccounts::class),
                    $app->make(UpdatesConnectedAccounts::class),
                    $app->make(HandlesInvalidState::class),
                );
            });
        }

        if (static::$registersRoutes) {
            $panel->routes(fn () => $this->registerPublicRoutes());
            $panel->authenticatedRoutes(fn () => $this->registerAuthenticatedRoutes());
        }
    }

    public function boot(Panel $panel): void
    {
        if (static::switchesCurrentCompany()) {
            Event::listen(TenantSet::class, SwitchCurrentCompany::class);
        }
    }
}
