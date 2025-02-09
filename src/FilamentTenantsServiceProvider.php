<?php

namespace Wallo\FilamentTenants;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Wallo\FilamentTenants\Http\Livewire\TenantEmployeeManager;
use Wallo\FilamentTenants\Http\Livewire\ConnectedAccountsForm;
use Wallo\FilamentTenants\Http\Livewire\DeleteTenantForm;
use Wallo\FilamentTenants\Http\Livewire\DeleteUserForm;
use Wallo\FilamentTenants\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentTenants\Http\Livewire\SetPasswordForm;
use Wallo\FilamentTenants\Http\Livewire\UpdateTenantNameForm;
use Wallo\FilamentTenants\Http\Livewire\UpdatePasswordForm;
use Wallo\FilamentTenants\Http\Livewire\UpdateProfileInformationForm;

class FilamentTenantsServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-tenants');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'filament-tenants');

        $this->configurePublishing();
        $this->configureCommands();

        $this->app->booted(function () {
            $this->configureComponents();
        });
    }

    /**
     * Configure the components offered by the application.
     */
    protected function configureComponents(): void
    {
        $featureComponentMap = [
            'update-profile-information-form' => [FilamentTenants::canUpdateProfileInformation(), UpdateProfileInformationForm::class],
            'update-password-form' => [FilamentTenants::canUpdatePasswords(), UpdatePasswordForm::class],
            'delete-user-form' => [FilamentTenants::hasAccountDeletionFeatures(), DeleteUserForm::class],
            'logout-other-browser-sessions-form' => [FilamentTenants::canManageBrowserSessions(), LogoutOtherBrowserSessionsForm::class],
            'update-tenant-name-form' => [FilamentTenants::hasTenantFeatures(), UpdateTenantNameForm::class],
            'tenant-employee-manager' => [FilamentTenants::hasTenantFeatures(), TenantEmployeeManager::class],
            'delete-tenant-form' => [FilamentTenants::hasTenantFeatures(), DeleteTenantForm::class],
            'set-password-form' => [FilamentTenants::canSetPasswords(), SetPasswordForm::class],
            'connected-accounts-form' => [FilamentTenants::canManageConnectedAccounts(), ConnectedAccountsForm::class],
        ];

        foreach ($featureComponentMap as $alias => [$enabled, $component]) {
            if ($enabled) {
                Livewire::component($alias, $component);
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
            __DIR__ . '/../resources/views' => resource_path('views/vendor/filament-tenants'),
        ], 'filament-tenants-views');

        $this->publishes([
            __DIR__ . '/../lang' => lang_path('vendor/filament-tenants'),
        ], 'filament-tenants-translations');

        $this->publishes([
            __DIR__ . '/../database/migrations/0001_01_01_000000_create_users_table.php' => database_path('migrations/0001_01_01_000000_create_users_table.php'),
        ], 'filament-tenants-migrations');

        $this->publishesMigrations([
            __DIR__ . '/../database/migrations/2020_05_21_100000_create_tenants_table.php' => database_path('migrations/2020_05_21_100000_create_tenants_table.php'),
            __DIR__ . '/../database/migrations/2020_05_21_200000_create_tenant_user_table.php' => database_path('migrations/2020_05_21_200000_create_tenant_user_table.php'),
            __DIR__ . '/../database/migrations/2020_05_21_300000_create_tenant_invitations_table.php' => database_path('migrations/2020_05_21_300000_create_tenant_invitations_table.php'),
        ], 'filament-tenants-tenant-migrations');

        $this->publishesMigrations([
            __DIR__ . '/../database/migrations/2020_12_22_000000_create_connected_accounts_table.php' => database_path('migrations/2020_12_22_000000_create_connected_accounts_table.php'),
        ], 'filament-tenants-socialite-migrations');
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
        ]);
    }
}
