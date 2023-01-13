<?php

namespace Wallo\FilamentCompanies;

use App\Actions\FilamentCompanies\DeleteCompany;
use App\Actions\FilamentCompanies\UpdateCompanyName;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laravel\Fortify\Fortify;
use Filament\Facades\Filament;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Http\Livewire\ApiTokenManager;
use Wallo\FilamentCompanies\Http\Livewire\CompanyEmployeeManager;
use Wallo\FilamentCompanies\Http\Livewire\CreateCompanyForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteCompanyForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentCompanies\Http\Livewire\NavigationMenu;
use Wallo\FilamentCompanies\Http\Livewire\TwoFactorAuthenticationForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm;
use Wallo\FilamentCompanies\Pages\Companies\CompanySettings;
use Wallo\FilamentCompanies\Pages\Companies\CreateCompany;
use Wallo\FilamentCompanies\Pages\User\APITokens;
use Wallo\FilamentCompanies\Pages\User\Profile;

class FilamentCompaniesServiceProvider extends ServiceProvider
{
    protected static string $name;

    protected array $pages = [];

    protected array $views = [];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->mergeConfigFrom(__DIR__.'/../config/filament-companies.php', 'filament-companies');

        $this->app->afterResolving(BladeCompiler::class, function () {
            if (config('filament-companies.stack') === 'filament' && class_exists(Livewire::class)) {
                Livewire::component(NavigationMenu::getName(), NavigationMenu::class);
                Livewire::component(UpdateProfileInformationForm::getName(), UpdateProfileInformationForm::class);
                Livewire::component(UpdatePasswordForm::getName(), UpdatePasswordForm::class);
                Livewire::component(TwoFactorAuthenticationForm::getName(), TwoFactorAuthenticationForm::class);
                Livewire::component(LogoutOtherBrowserSessionsForm::getName(), LogoutOtherBrowserSessionsForm::class);
                Livewire::component(DeleteUserForm::getName(), DeleteUserForm::class);

                if (Features::hasApiFeatures()) {
                    Livewire::component(ApiTokenManager::getName(), ApiTokenManager::class);
                }

                if (Features::hasCompanyFeatures()) {
                    Livewire::component(CreateCompanyForm::getName(), CreateCompanyForm::class);
                    Livewire::component(UpdateCompanyNameForm::getName(), UpdateCompanyNameForm::class);
                    Livewire::component(CompanyEmployeeManager::getName(), CompanyEmployeeManager::class);
                    Livewire::component(DeleteCompanyForm::getName(), DeleteCompanyForm::class);
                }
            }
        });

        $this->app->resolving('filament', function () {
            Filament::registerPages($this->getPages());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-companies');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'filament-companies');

        foreach ($this->getPages() as $page) {
            Livewire::component($page::getName(), $page);
        }

        Fortify::viewPrefix('filament-companies::auth.');

        $this->configureComponents();
        $this->configurePublishing();
        $this->configureRoutes();
        $this->configureCommands();
        $this->registerMacros();
    }

    /**
     * Configure the Company Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            Blade::component('filament-companies::components.action-message', 'filament-companies::action-message');
            Blade::component('filament-companies::components.action-section', 'filament-companies::action-section');
            Blade::component('filament-companies::components.confirmation-modal', 'filament-companies::confirmation-modal');
            Blade::component('filament-companies::components.confirms-password', 'filament-companies::confirms-password');
            Blade::component('filament-companies::components.dialog-modal', 'filament-companies::dialog-modal');
            Blade::component('filament-companies::components.dropdown', 'filament-companies::dropdown');
            Blade::component('filament-companies::components.dropdown-link', 'filament-companies::dropdown-link');
            Blade::component('filament-companies::components.grid-section', 'filament-companies::grid-section');
            Blade::component('filament-companies::components.input', 'filament-companies::input');
            Blade::component('filament-companies::components.checkbox', 'filament-companies::checkbox');
            Blade::component('filament-companies::components.input-error', 'filament-companies::input-error');
            Blade::component('filament-companies::components.label', 'filament-companies::label');
            Blade::component('filament-companies::components.modal', 'filament-companies::modal');
            Blade::component('filament-companies::components.nav-link', 'filament-companies::nav-link');
            Blade::component('filament-companies::components.responsive-nav-link', 'filament-companies::responsive-nav-link');
            Blade::component('filament-companies::components.responsive-switchable-company', 'filament-companies::responsive-switchable-company');
            Blade::component('filament-companies::components.section-border', 'filament-companies::section-border');
            Blade::component('filament-companies::components.section-title', 'filament-companies::section-title');
            Blade::component('filament-companies::components.switchable-company', 'filament-companies::switchable-company');
            Blade::component('filament-companies::components.validation-errors', 'filament-companies::validation-errors');

            Blade::component('filament-companies::api.api-token-manager', 'filament-companies::api.api-token-manager');
            Blade::component('filament-companies::companies.company-employee-manager', 'filament-companies::companies.company-employee-manager');

            Blade::component('filament-companies::companies.create-company-form', 'filament-companies::companies.create-company-form');
            Blade::component('filament-companies::companies.delete-company-form', 'filament-companies::companies.delete-company-form');

            Blade::component('filament-companies::companies.update-company-name-form', 'filament-companies::companies.update-company-name-form');
            Blade::component('filament-companies::dropdown.navigation-menu', 'filament-companies::dropdown.navigation-menu');

            Blade::component('filament-companies::profile.delete-user-form', 'filament-companies::profile.delete-user-form');
            Blade::component('filament-companies::profile.logout-other-browser-sessions-form', 'filament-companies::profile.logout-other-browser-sessions-form');

            Blade::component('filament-companies::profile.two-factor-authentication-form', 'filament-companies::profile.two-factor-authentication-form');
            Blade::component('filament-companies::profile.update-password-form', 'filament-companies::profile.update-password-form');
            Blade::component('filament-companies::profile.update-profile-information-form', 'filament-companies::profile.update-profile-information-form');
        });
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../stubs/config/filament-companies.php' => config_path('filament-companies.php'),
        ], 'filament-companies-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/filament-companies'),
        ], 'filament-companies-views');

        $this->publishes([
            __DIR__.'/../database/migrations/2014_10_12_000000_create_users_table.php' => database_path('migrations/2014_10_12_000000_create_users_table.php'),
        ], 'filament-companies-migrations');

        $this->publishes([
            __DIR__.'/../database/migrations/2020_05_21_100000_create_companies_table.php' => database_path('migrations/2020_05_21_100000_create_companies_table.php'),
            __DIR__.'/../database/migrations/2020_05_21_200000_create_company_user_table.php' => database_path('migrations/2020_05_21_200000_create_company_user_table.php'),
            __DIR__.'/../database/migrations/2020_05_21_300000_create_company_invitations_table.php' => database_path('migrations/2020_05_21_300000_create_company_invitations_table.php'),
        ], 'filament-companies-company-migrations');

        $this->publishes([
            __DIR__.'/../routes/web.php' => base_path('routes/filament-companies.php'),
        ], 'filament-companies-routes');
    }

    /**
     * Configure the routes offered by the application.
     *
     * @return void
     */
    protected function configureRoutes()
    {
        if (FilamentCompanies::$registersRoutes) {
            Route::group([
                'domain' => config('filament.domain'),
                'middleware' => config('filament.middleware.base'),
                'name' => config('filament.'),
                'name' => config('filament-companies.terms_and_privacy_route_group_prefix'),
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            });
        }
    }

    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }

    protected function getPages(): array
    {
        return [
            Profile::class,
            APITokens::class,
            CompanySettings::class,
            CreateCompany::class,
        ];
    }

    protected function registerMacros(): void
    {
    }
}
