<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Laravel\Fortify\Fortify;
use Filament\Facades\Filament;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Pages\Companies\CompanySettings;
use Wallo\FilamentCompanies\Pages\Companies\CreateCompany;
use Wallo\FilamentCompanies\Pages\User\APITokens;
use Wallo\FilamentCompanies\Pages\User\Profile;

class FilamentCompaniesServiceProvider extends ServiceProvider
{
    protected static string $name;

    protected array $pages = [];


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->mergeConfigFrom(__DIR__.'/../config/filament-companies.php', 'filament-companies');

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

        //$this->configureComponents();
        $this->configurePublishing();
        $this->configureRoutes();
        $this->configureCommands();
    }

    /**
     * Configure the Company Blade components.
     *
     * @return void
     */
    //protected function configureComponents()
    //{
        //$this->callAfterResolving(BladeCompiler::class, function () {
            //$this->registerComponent('action-message');
            //$this->registerComponent('action-section');
            //$this->registerComponent('confirmation-modal');
            //$this->registerComponent('confirms-password');
            //$this->registerComponent('dialog-modal');
            //$this->registerComponent('dropdown');
           // $this->registerComponent('dropdown-link');
           // $this->registerComponent('grid-section');
            //$this->registerComponent('input');
           // $this->registerComponent('checkbox');
           // $this->registerComponent('input-error');
           // $this->registerComponent('label');
           // $this->registerComponent('modal');
           // $this->registerComponent('nav-link');
           // $this->registerComponent('responsive-nav-link');
           // $this->registerComponent('responsive-switchable-company');
            //$this->registerComponent('section-border');
            //$this->registerComponent('section-title');
           // $this->registerComponent('switchable-company');
            //$this->registerComponent('validation-errors');
        //});
    //}

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    //protected function registerComponent(string $component)
    //{
        //Blade::component('filament-companies::components.'.$component, 'filament-companies::'.$component);
    //}

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

        //$this->publishes([
            //__DIR__.'/../resources/views' => resource_path('views/vendor/filament-companies'),
        //], 'filament-companies-views');

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
                'domain' => config('filament.domain', null),
                'prefix' => config('filament-companies.prefix', config('filament-companies.path')),
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
}
