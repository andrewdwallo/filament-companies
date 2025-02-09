<?php

namespace Wallo\FilamentTenants\Pages\Tenant;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Tenancy\RegisterTenant as FilamentRegisterTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Wallo\FilamentTenants\Events\AddingTenant;
use Wallo\FilamentTenants\FilamentTenants;

class CreateTenant extends FilamentRegisterTenant
{
    protected static string $view = 'filament-tenants::filament.pages.tenants.create_tenant';

    public static function getLabel(): string
    {
        return __('filament-tenants::default.pages.titles.create_tenant');
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

    protected function handleRegistration(array $data): Model
    {
        $user = Auth::user();

        Gate::forUser($user)->authorize('create', FilamentTenants::newTenantModel());

        AddingTenant::dispatch($user);

        $personalTenant = $user?->personalTenant() === null;

        $tenant = $user?->ownedTenants()->create([
            'name' => $data['name'],
            'personal_tenant' => $personalTenant,
        ]);

        $user?->switchTenant($tenant);

        $name = $data['name'];

        $this->tenantCreated($name);

        return $tenant;
    }

    protected function tenantCreated($name): void
    {
        Notification::make()
            ->title(__('filament-tenants::default.notifications.tenant_created.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-tenants::default.notifications.tenant_created.body', compact('name'))))
            ->send();
    }
}
