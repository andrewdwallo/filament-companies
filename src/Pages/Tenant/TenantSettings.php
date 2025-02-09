<?php

namespace Wallo\FilamentTenants\Pages\Tenant;

use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile as BaseEditTenantProfile;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Wallo\FilamentTenants\FilamentTenants;

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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('filament-tenants::default.labels.tenant_name'))
                    ->autofocus()
                    ->maxLength(255)
                    ->required(),
            ])
            ->model(FilamentTenants::tenantModel())
            ->statePath('data');
    }

    protected function getViewData(): array
    {
        return [
            'tenant' => Filament::getTenant(),
        ];
    }
}
