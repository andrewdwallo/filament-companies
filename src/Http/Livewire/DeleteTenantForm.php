<?php

namespace Wallo\FilamentTenants\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Wallo\FilamentTenants\Actions\ValidateTenantDeletion;
use Wallo\FilamentTenants\Contracts\DeletesTenants;
use Wallo\FilamentTenants\FilamentTenants;
use Wallo\FilamentTenants\RedirectsActions;

class DeleteTenantForm extends Component
{
    use RedirectsActions;

    /**
     * The tenant instance.
     */
    public mixed $tenant;

    /**
     * Mount the component.
     */
    public function mount(mixed $tenant): void
    {
        $this->tenant = $tenant;
    }

    /**
     * Delete the tenant.
     *
     * @throws AuthorizationException
     */
    public function deleteTenant(ValidateTenantDeletion $validator, DeletesTenants $deleter): Response | Redirector | RedirectResponse
    {
        $validator->validate(Auth::user(), $this->tenant);

        $deleter->delete($this->tenant);

        if (FilamentTenants::hasNotificationsFeature()) {
            if (method_exists($deleter, 'tenantDeleted')) {
                $deleter->tenantDeleted($this->tenant);
            } else {
                $this->tenantDeleted($this->tenant);
            }
        }

        $this->tenant = null;

        return $this->redirectPath($deleter);
    }

    /**
     * Cancel the tenant deletion.
     */
    public function cancelTenantDeletion(): void
    {
        $this->dispatch('close-modal', id: 'confirmingTenantDeletion');
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-tenants::tenants.delete-tenant-form');
    }

    public function tenantDeleted($tenant): void
    {
        $name = $tenant->name;

        Notification::make()
            ->title(__('filament-tenants::default.notifications.tenant_deleted.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-tenants::default.notifications.tenant_deleted.body', compact('name'))))
            ->send();
    }
}
