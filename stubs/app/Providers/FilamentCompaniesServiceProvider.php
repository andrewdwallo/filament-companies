<?php

namespace App\Providers;

use App\Actions\FilamentCompanies\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {
        $this->configurePermissions();

        FilamentCompanies::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     */
    protected function configurePermissions(): void
    {
        FilamentCompanies::defaultApiTokenPermissions(['read']);

        FilamentCompanies::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
