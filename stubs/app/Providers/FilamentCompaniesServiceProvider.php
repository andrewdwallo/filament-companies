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
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        FilamentCompanies::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
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
