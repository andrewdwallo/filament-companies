<?php

namespace Wallo\FilamentCompanies;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Http\Livewire\CompanyEmployeeManager;
use Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteCompanyForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentCompanies\Http\Livewire\SetPasswordForm;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-companies');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'filament-companies');

        $this->configurePublishing();
        $this->configureCommands();

        Filament::serving(function () {
            $this->configureRoutes();
            $this->configureComponents();
        });
    }

    /**
     * Configure the components offered by the application.
     */
    protected function configureComponents(): void
    {
        if (class_exists(Livewire::class)) {

            $featureComponentMap = [
                'update-profile-information-form' => [Features::canUpdateProfileInformation(), UpdateProfileInformationForm::class],
                'update-password-form' => [Features::canUpdatePasswords(), UpdatePasswordForm::class],
                'delete-user-form' => [Features::hasAccountDeletionFeatures(), DeleteUserForm::class],
                'logout-other-browser-sessions-form' => [Features::canManageBrowserSessions(), LogoutOtherBrowserSessionsForm::class],
                'update-company-name-form' => [Features::hasCompanyFeatures(), UpdateCompanyNameForm::class],
                'company-employee-manager' => [Features::hasCompanyFeatures(), CompanyEmployeeManager::class],
                'delete-company-form' => [Features::hasCompanyFeatures(), DeleteCompanyForm::class],
                'set-password-form' => [Socialite::canSetPasswords(), SetPasswordForm::class],
                'connected-accounts-form' => [Socialite::canManageConnectedAccounts(), ConnectedAccountsForm::class],
            ];

            foreach ($featureComponentMap as $alias => [$enabled, $component]) {
                if ($enabled) {
                    Livewire::component($alias, $component);
                }
            }
        }
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
