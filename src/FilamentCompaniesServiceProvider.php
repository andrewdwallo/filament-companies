<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laravel\Fortify\Fortify;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Http\Livewire\CompanyEmployeeManager;
use Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm;
use Wallo\FilamentCompanies\Http\Livewire\CreateCompanyForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteCompanyForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentCompanies\Http\Livewire\SetPasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\TwoFactorAuthenticationForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm;

class FilamentCompaniesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filament-companies.php', 'filament-companies');

        $this->app->afterResolving(BladeCompiler::class, static function () {
            if (class_exists(Livewire::class) && config('filament-companies.stack') === 'filament') {
                Livewire::component('update-profile-information-form', UpdateProfileInformationForm::class);
                Livewire::component('update-password-form', UpdatePasswordForm::class);
                Livewire::component('two-factor-authentication-form', TwoFactorAuthenticationForm::class);
                Livewire::component('logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
                Livewire::component('delete-user-form', DeleteUserForm::class);

                if (Features::hasCompanyFeatures()) {
                    Livewire::component('create-company-form', CreateCompanyForm::class);
                    Livewire::component('update-company-name-form', UpdateCompanyNameForm::class);
                    Livewire::component('company-employee-manager', CompanyEmployeeManager::class);
                    Livewire::component('delete-company-form', DeleteCompanyForm::class);
                }

                if (Socialite::hasSocialiteFeatures()) {
                    Livewire::component('set-password-form', SetPasswordForm::class);
                    Livewire::component('connected-accounts-form', ConnectedAccountsForm::class);
                }
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-companies');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'filament-companies');

        Fortify::viewPrefix('filament-companies::auth.');

        // $this->configureComponents();
        $this->configurePublishing();
        $this->configureRoutes();
        $this->configureCommands();
    }

    /**
     * Configure publishing for the package.
     */
    protected function configurePublishing(): void
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
            __DIR__.'/../lang' => lang_path('vendor/filament-companies'),
        ], 'filament-companies-translations');

        $this->publishes([
            __DIR__.'/../database/migrations/2014_10_12_000000_create_users_table.php' => database_path('migrations/2014_10_12_000000_create_users_table.php'),
        ], 'filament-companies-migrations');

        $this->publishes([
            __DIR__.'/../database/migrations/2020_05_21_100000_create_companies_table.php' => database_path('migrations/2020_05_21_100000_create_companies_table.php'),
            __DIR__.'/../database/migrations/2020_05_21_200000_create_company_user_table.php' => database_path('migrations/2020_05_21_200000_create_company_user_table.php'),
            __DIR__.'/../database/migrations/2020_05_21_300000_create_company_invitations_table.php' => database_path('migrations/2020_05_21_300000_create_company_invitations_table.php'),
        ], 'filament-companies-company-migrations');

        $this->publishes([
            __DIR__.'/../database/migrations/2020_12_22_000000_create_connected_accounts_table.php' => database_path('migrations/2020_12_22_000000_create_connected_accounts_table.php'),
        ], 'filament-companies-socialite-migrations');
    }

    /**
     * Configure the routes offered by the application.
     */
    protected function configureRoutes(): void
    {
        if (FilamentCompanies::$registersRoutes) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }
    }

    /**
     * Configure the commands offered by the application.
     */
    protected function configureCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
            Console\MakeUserCommand::class,
        ]);
    }
}
