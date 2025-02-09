<?php

namespace Wallo\FilamentTenants\Pages\Tenant;

use Filament\Facades\Filament;
use Filament\Pages\Tenancy\EditTenantProfile as BaseEditTenantProfile;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;

use function Filament\authorize;

class TenantSettings extends BaseEditTenantProfile
{
    protected static string $view = 'filament-tenants::filament.pages.tenants.tenant_settings';

    public static function getLabel(): string
    {
        return __('filament-tenants::default.pages.titles.tenant_settings');
    }

    public static function canView(Model $tenant): bool
    {
        try {
            return authorize('view', $tenant)->allowed();
        } catch (AuthorizationException $exception) {
            return $exception->toResponse()->allowed();
        }
    }

    protected function getViewData(): array
    {
        return [
            'tenant' => Filament::getTenant(),
        ];
    }
}
