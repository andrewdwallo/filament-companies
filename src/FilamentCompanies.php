<?php

namespace Wallo\FilamentCompanies;

use Filament\Auth\Http\Responses\Contracts\RegistrationResponse as RegistrationResponseContract;
use Filament\Contracts\Plugin;
use Filament\Events\TenantSet;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Wallo\FilamentCompanies\Contracts\HandlesInvalidState;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
use Wallo\FilamentCompanies\Http\Controllers\OAuthController;
use Wallo\FilamentCompanies\Http\Responses\Auth\FilamentCompaniesRegistrationResponse;
use Wallo\FilamentCompanies\Listeners\SwitchCurrentCompany;
use Wallo\FilamentCompanies\Pages\Company\CompanySettings;
use Wallo\FilamentCompanies\Pages\Company\CreateCompany;

class FilamentCompanies implements Plugin
{
    use Concerns\Base\HasAddedCompanyComponents;
    use Concerns\Base\HasAddedProfileComponents;
    use Concerns\Base\HasAutoAcceptInvitations;
    use Concerns\Base\HasBaseActionBindings;
    use Concerns\Base\HasBaseModels;
    use Concerns\Base\HasBaseProfileComponents;
    use Concerns\Base\HasBaseProfileFeatures;
    use Concerns\Base\HasCompanyFeatures;
    use Concerns\Base\HasModals;
    use Concerns\Base\HasNotifications;
    use Concerns\Base\HasPanels;
    use Concerns\Base\HasPermissions;
    use Concerns\Base\HasRoutes;
    use Concerns\Base\HasTermsAndPrivacyPolicy;
    use Concerns\ManagesCompanyComponents;
    use Concerns\ManagesProfileComponents;
    use Concerns\Socialite\CanEnableSocialite;
    use Concerns\Socialite\HasConnectedAccountModel;
    use Concerns\Socialite\HasProviderFeatures;
    use Concerns\Socialite\HasProviders;
    use Concerns\Socialite\HasSocialiteActionBindings;
    use Concerns\Socialite\HasSocialiteComponents;
    use Concerns\Socialite\HasSocialiteProfileFeatures;

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
        static::$companyPanel = $panel->getId();

        if (static::hasCompanyFeatures()) {
            Livewire::component('filament.pages.companies.create_company', CreateCompany::class);
            Livewire::component('filament.pages.companies.company_settings', CompanySettings::class);
        }

        app()->bind(RegistrationResponseContract::class, FilamentCompaniesRegistrationResponse::class);

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

        if (static::hasSocialiteFeatures()) {
            $this->registerSocialiteRenderHooks();
        }
    }

    protected function registerSocialiteRenderHooks(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
            fn (): View => view('filament-companies::components.socialite-login'),
        );

        FilamentView::registerRenderHook(
            PanelsRenderHook::AUTH_REGISTER_FORM_AFTER,
            fn (): View => view('filament-companies::components.socialite-login'),
        );
    }
}
