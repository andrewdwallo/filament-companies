<?php

namespace App\Providers;

use App\Actions\FilamentTenants\AddTenantEmployee;
use App\Actions\FilamentTenants\CreateNewUser;
use App\Actions\FilamentTenants\DeleteTenant;
use App\Actions\FilamentTenants\DeleteUser;
use App\Actions\FilamentTenants\InviteTenantEmployee;
use App\Actions\FilamentTenants\RemoveTenantEmployee;
use App\Actions\FilamentTenants\UpdateTenantName;
use App\Actions\FilamentTenants\UpdateUserPassword;
use App\Actions\FilamentTenants\UpdateUserProfileInformation;
use App\Models\Tenant;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Wallo\FilamentTenants\FilamentTenants;
use Wallo\FilamentTenants\Pages\Auth\Login;
use Wallo\FilamentTenants\Pages\Auth\Register;
use Wallo\FilamentTenants\Pages\Tenant\TenantSettings;
use Wallo\FilamentTenants\Pages\Tenant\CreateTenant;
use Wallo\FilamentTenants\Pages\User\Profile;

class FilamentTenantsServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('tenant')
            ->path('tenant')
            ->default()
            ->login(Login::class)
            ->passwordReset()
            ->homeUrl(function (): ?string {
                $user = Auth::user();

                if ($tenant = $user?->primaryTenant()) {
                    return Pages\Dashboard::getUrl(panel: 'tenant', tenant: $tenant);
                }

                return Filament::getPanel(FilamentTenants::getTenantPanel())->getTenantRegistrationUrl();
            })
            ->plugin(
                FilamentTenants::make()
                    ->userPanel('admin')
                    ->switchCurrentTenant()
                    ->updateProfileInformation()
                    ->updatePasswords()
                    ->manageBrowserSessions()
                    ->accountDeletion()
                    ->profilePhotos()
                    ->api()
                    ->tenants(invitations: true)
                    ->autoAcceptInvitations()
                    ->termsAndPrivacyPolicy()
                    ->notifications()
                    ->modals(),
            )
            ->registration(Register::class)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->tenant(Tenant::class)
            ->tenantProfile(TenantSettings::class)
            ->tenantRegistration(CreateTenant::class)
            ->discoverResources(in: app_path('Filament/Tenant/Resources'), for: 'App\\Filament\\Tenant\\Resources')
            ->discoverPages(in: app_path('Filament/Tenant/Pages'), for: 'App\\Filament\\Tenant\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label('Profile')
                    ->icon('heroicon-o-user-circle')
                    ->url(static fn () => route(Profile::getRouteName(panel: 'admin'))),
            ])
            ->authGuard('web')
            ->discoverWidgets(in: app_path('Filament/Tenant/Widgets'), for: 'App\\Filament\\Tenant\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        FilamentTenants::createUsersUsing(CreateNewUser::class);
        FilamentTenants::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        FilamentTenants::updateUserPasswordsUsing(UpdateUserPassword::class);

        FilamentTenants::createTenantsUsing(CreateTenant::class);
        FilamentTenants::updateTenantNamesUsing(UpdateTenantName::class);
        FilamentTenants::addTenantEmployeesUsing(AddTenantEmployee::class);
        FilamentTenants::inviteTenantEmployeesUsing(InviteTenantEmployee::class);
        FilamentTenants::removeTenantEmployeesUsing(RemoveTenantEmployee::class);
        FilamentTenants::deleteTenantsUsing(DeleteTenant::class);
        FilamentTenants::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        FilamentTenants::defaultApiTokenPermissions(['read']);

        FilamentTenants::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        FilamentTenants::role('editor', 'Editor', [
            'read',
            'create',
            'update',
        ])->description('Editor users have the ability to read, create, and update.');
    }
}
