<?php

namespace Wallo\FilamentTenants\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Wallo\FilamentTenants\Contracts\CreatesTenants;
use Wallo\FilamentTenants\RedirectsActions;

class CreateTenantForm extends Component
{
    use RedirectsActions;

    /**
     * The component's state.
     */
    public array $state = [];

    /**
     * Create a new tenant.
     */
    public function createTenant(CreatesTenants $creator): Response | Redirector | RedirectResponse
    {
        $this->resetErrorBag();

        $creator->create($this->user, $this->state);

        $name = $this->state['name'];

        $this->tenantCreated($name);

        return $this->redirectPath($creator);
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
        return view('filament-tenants::tenants.create-tenant-form');
    }

    public function tenantCreated($name): void
    {
        Notification::make()
            ->title(__('filament-tenants::default.notifications.tenant_created.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-tenants::default.notifications.tenant_created.body', compact('name'))))
            ->send();
    }
}
