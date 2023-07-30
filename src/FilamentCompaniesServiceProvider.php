<?php

namespace Wallo\FilamentCompanies;

use Filament\FilamentManager;
use Illuminate\Support\Facades\Route;
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
use Wallo\FilamentCompanies\Pages\Companies\CompanySettings;
use Wallo\FilamentCompanies\Pages\Companies\CreateCompany;
use Wallo\FilamentCompanies\Pages\User\APITokens;
use Wallo\FilamentCompanies\Pages\User\Profile;

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
                Livewire::component(UpdateProfileInformationForm::getName(), UpdateProfileInformationForm::class);
                Livewire::component(UpdatePasswordForm::getName(), UpdatePasswordForm::class);
                Livewire::component(TwoFactorAuthenticationForm::getName(), TwoFactorAuthenticationForm::class);
                Livewire::component(LogoutOtherBrowserSessionsForm::getName(), LogoutOtherBrowserSessionsForm::class);
                Livewire::component(DeleteUserForm::getName(), DeleteUserForm::class);

                if (Features::hasCompanyFeatures()) {
                    Livewire::component(CreateCompanyForm::getName(), CreateCompanyForm::class);
                    Livewire::component(UpdateCompanyNameForm::getName(), UpdateCompanyNameForm::class);
                    Livewire::component(CompanyEmployeeManager::getName(), CompanyEmployeeManager::class);
                    Livewire::component(DeleteCompanyForm::getName(), DeleteCompanyForm::class);
                }

                if (Features::hasSocialiteFeatures()) {
                    Livewire::component(SetPasswordForm::getName(), SetPasswordForm::class);
                    Livewire::component(ConnectedAccountsForm::getName(), ConnectedAccountsForm::class);
                }
            }
        });

        $this->app->resolving('filament', function (FilamentManager $filament) {
            $filament->registerPages($this->getPages());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-companies');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'filament-companies');

        foreach ($this->getPages() as $page) {
            Livewire::component(app($page)::getName(), $page);
        }

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
            Route::group([
                'domain' => config('filament.domain'),
                'middleware' => config('filament.middleware.base'),
                'name' => config('filament.'),
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            });
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

    protected function getPages(): array
    {
        $pages = [
            Profile::class,
        ];

        if (Features::hasApiFeatures()) {
            $pages[] = APITokens::class;
        }

        if (Features::hasCompanyFeatures()) {
            $pages[] = CompanySettings::class;
            $pages[] = CreateCompany::class;
        }

        return $pages;
    }
}
