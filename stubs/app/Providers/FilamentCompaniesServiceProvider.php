<?php

namespace App\Providers;

use App\Actions\FilamentCompanies\AddCompanyEmployee;
use App\Actions\FilamentCompanies\CreateCompany;
use App\Actions\FilamentCompanies\DeleteCompany;
use App\Actions\FilamentCompanies\DeleteUser;
use App\Actions\FilamentCompanies\InviteCompanyEmployee;
use App\Actions\FilamentCompanies\RemoveCompanyEmployee;
use App\Actions\FilamentCompanies\UpdateCompanyName;
use Illuminate\Support\ServiceProvider;
use Wallo\FilamentCompanies\FilamentCompanies;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Filament\Navigation\UserMenuItem;
use Wallo\FilamentCompanies\Pages\User\APITokens;
use Wallo\FilamentCompanies\Pages\User\Profile;

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

        if (FilamentCompanies::hasCompanyFeatures()) {
            Filament::registerRenderHook(
                'global-search.start',
                fn (): View => view('filament-companies::components.dropdown.navigation-menu'),
            );
        }

        Filament::serving(function () {
            Filament::registerUserMenuItems([
                'account' => UserMenuItem::make()->url(Profile::getUrl()),
                // ...
            ]);
        });

        if (FilamentCompanies::hasApiFeatures()) {
            Filament::serving(function () {
                Filament::registerUserMenuItems([
                    UserMenuItem::make()
                    ->label('API Tokens')
                    ->icon('heroicon-s-lock-open')
                    ->url(APITokens::getUrl()),
                ]);
            });
        }

        Filament::serving(function() {
            Filament::registerUserMenuItems([
                'logout' => UserMenuItem::make()->url(route('logout')),
            ]);
        });

        $this->configurePermissions();

        FilamentCompanies::createCompaniesUsing(CreateCompany::class);
        FilamentCompanies::updateCompanyNamesUsing(UpdateCompanyName::class);
        FilamentCompanies::addCompanyEmployeesUsing(AddCompanyEmployee::class);
        FilamentCompanies::inviteCompanyEmployeesUsing(InviteCompanyEmployee::class);
        FilamentCompanies::removeCompanyEmployeesUsing(RemoveCompanyEmployee::class);
        FilamentCompanies::deleteCompaniesUsing(DeleteCompany::class);
        FilamentCompanies::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     */
    protected function configurePermissions(): void
    {
        FilamentCompanies::defaultApiTokenPermissions(['read']);

        FilamentCompanies::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        FilamentCompanies::role('editor', 'Editor', [
            'read',
            'create',
            'update',
        ])->description('Editor users have the ability to read, create, and update.');
    }
}
