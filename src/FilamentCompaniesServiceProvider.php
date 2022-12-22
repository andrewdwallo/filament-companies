<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laravel\Fortify\Fortify;
use Wallo\FilamentCompanies\Http\Livewire\ApiTokenManager;
use Wallo\FilamentCompanies\Http\Livewire\CreateCompanyForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteCompanyForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentCompanies\Http\Livewire\NavigationMenu;
use Wallo\FilamentCompanies\Http\Livewire\CompanyEmployeeManager;
use Wallo\FilamentCompanies\Http\Livewire\TwoFactorAuthenticationForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm;
use Livewire\Livewire;

class FilamentCompaniesServiceProvider extends ServiceProvider
{
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
                Livewire::component('navigation-menu', NavigationMenu::class);
                Livewire::component('profile.update-profile-information-form', UpdateProfileInformationForm::class);
                Livewire::component('profile.update-password-form', UpdatePasswordForm::class);
                Livewire::component('profile.two-factor-authentication-form', TwoFactorAuthenticationForm::class);
                Livewire::component('profile.logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
                Livewire::component('profile.delete-user-form', DeleteUserForm::class);

                if (Features::hasApiFeatures()) {
                    Livewire::component('api.api-token-manager', ApiTokenManager::class);
                }

                if (Features::hasCompanyFeatures()) {
                    Livewire::component('companies.create-company-form', CreateCompanyForm::class);
                    Livewire::component('companies.update-company-name-form', UpdateCompanyNameForm::class);
                    Livewire::component('companies.company-employee-manager', CompanyEmployeeManager::class);
                    Livewire::component('companies.delete-company-form', DeleteCompanyForm::class);
                }
            }
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

        Fortify::viewPrefix('auth.');

        $this->configureComponents();
        $this->configurePublishing();
        $this->configureRoutes();
        $this->configureCommands();
    }

    /**
     * Configure the Company Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('action-message');
            $this->registerComponent('action-section');
            $this->registerComponent('confirmation-modal');
            $this->registerComponent('confirms-password');
            $this->registerComponent('dialog-modal');
            $this->registerComponent('dropdown');
            $this->registerComponent('dropdown-link');
            $this->registerComponent('grid-section');
            $this->registerComponent('input');
            $this->registerComponent('checkbox');
            $this->registerComponent('input-error');
            $this->registerComponent('label');
            $this->registerComponent('modal');
            $this->registerComponent('nav-link');
            $this->registerComponent('responsive-nav-link');
            $this->registerComponent('responsive-switchable-company');
            $this->registerComponent('section-border');
            $this->registerComponent('section-title');
            $this->registerComponent('switchable-company');
            $this->registerComponent('validation-errors');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('filament-companies::components.'.$component, 'filament-companies::'.$component);
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
            __DIR__.'/../routes/'.config('filament-companies.stack').'.php' => base_path('routes/filament-companies.php'),
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
                'namespace' => 'Laravel\FilamentCompanies\Http\Controllers',
                'domain' => config('filament-companies.domain', null),
                'prefix' => config('filament-companies.prefix', config('filament-companies.path')),
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/'.config('filament-companies.stack').'.php');
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
}
