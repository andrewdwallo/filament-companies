<?php

namespace Wallo\FilamentTenants\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Wallo\FilamentTenants\Contracts\UpdatesTenantNames;
use Wallo\FilamentTenants\FilamentTenants;

class UpdateTenantNameForm extends Component
{
    /**
     * The tenant instance.
     */
    public mixed $tenant;

    /**
     * The component's state.
     */
    public array $state = [];

    /**
     * Mount the component.
     */
    public function mount(mixed $tenant): void
    {
        $this->tenant = $tenant;

        $this->state = $tenant->withoutRelations()->toArray();
    }

    /**
     * Update the tenant's name.
     */
    public function updateTenantName(UpdatesTenantNames $updater): void
    {
        $this->resetErrorBag();

        $updater->update($this->user, $this->tenant, $this->state);

        if (FilamentTenants::hasNotificationsFeature()) {
            if (method_exists($updater, 'tenantNameUpdated')) {
                $updater->tenantNameUpdated($this->user, $this->tenant, $this->state);
            } else {
                $this->tenantNameUpdated($this->tenant);
            }
        }
    }

    protected function tenantNameUpdated($tenant): void
    {
        $name = $tenant->name;

        Notification::make()
            ->title(__('filament-tenants::default.notifications.tenant_name_updated.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-tenants::default.notifications.tenant_name_updated.body', compact('name'))))
            ->send();
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
    {
        return Auth::user();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-tenants::tenants.update-tenant-name-form');
    }
}
