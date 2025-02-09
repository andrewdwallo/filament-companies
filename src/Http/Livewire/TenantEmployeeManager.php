<?php

namespace Wallo\FilamentTenants\Http\Livewire;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Wallo\FilamentTenants\Actions\UpdateTenantEmployeeRole;
use Wallo\FilamentTenants\Contracts\AddsTenantEmployees;
use Wallo\FilamentTenants\Contracts\InvitesTenantEmployees;
use Wallo\FilamentTenants\Contracts\RemovesTenantEmployees;
use Wallo\FilamentTenants\FilamentTenants;
use Wallo\FilamentTenants\RedirectsActions;
use Wallo\FilamentTenants\Role;

class TenantEmployeeManager extends Component
{
    use RedirectsActions;

    /**
     * The tenant instance.
     */
    public mixed $tenant;

    /**
     * The user that is having their role managed.
     */
    public mixed $managingRoleFor;

    /**
     * The current role for the user that is having their role managed.
     */
    public string $currentRole;

    /**
     * The ID of the tenant employee being removed.
     */
    public ?int $tenantEmployeeIdBeingRemoved = null;

    /**
     * The "add tenant employee" form state.
     *
     * @var array<string, mixed>
     */
    public $addTenantEmployeeForm = [
        'email' => '',
        'role' => null,
    ];

    /**
     * Mount the component.
     */
    public function mount(mixed $tenant): void
    {
        $this->tenant = $tenant;
    }

    /**
     * Add a new tenant employee to a tenant.
     */
    public function addTenantEmployee(InvitesTenantEmployees $inviter, AddsTenantEmployees $adder): void
    {
        $this->resetErrorBag();

        if (FilamentTenants::sendsTenantInvitations()) {
            $inviter->invite(
                $this->user,
                $this->tenant,
                $this->addTenantEmployeeForm['email'],
                $this->addTenantEmployeeForm['role']
            );
        } else {
            $adder->add(
                $this->user,
                $this->tenant,
                $this->addTenantEmployeeForm['email'],
                $this->addTenantEmployeeForm['role']
            );
        }

        if (FilamentTenants::hasNotificationsFeature()) {
            if (method_exists($inviter, 'employeeInvitationSent')) {
                $inviter->employeeInvitationSent(
                    $this->user,
                    $this->tenant,
                    $this->addTenantEmployeeForm['email'],
                    $this->addTenantEmployeeForm['role']
                );
            } else {
                $email = $this->addTenantEmployeeForm['email'];
                $this->employeeInvitationSent($email);
            }
        }

        $this->addTenantEmployeeForm = [
            'email' => '',
            'role' => null,
        ];

        $this->tenant = $this->tenant->fresh();
    }

    /**
     * Cancel a pending tenant employee invitation.
     */
    public function cancelTenantInvitation(int $invitationId): void
    {
        if (! empty($invitationId)) {
            $model = FilamentTenants::tenantInvitationModel();

            $model::whereKey($invitationId)->delete();
        }

        $this->tenant = $this->tenant->fresh();
    }

    /**
     * Allow the given user's role to be managed.
     */
    public function manageRole(int $userId): void
    {
        $this->dispatch('open-modal', id: 'currentlyManagingRole');
        $this->managingRoleFor = FilamentTenants::findUserByIdOrFail($userId);
        $this->currentRole = $this->managingRoleFor->tenantRole($this->tenant)->key;
    }

    /**
     * Save the role for the user being managed.
     *
     * @throws AuthorizationException
     */
    public function updateRole(UpdateTenantEmployeeRole $updater): void
    {
        $updater->update(
            $this->user,
            $this->tenant,
            $this->managingRoleFor->id,
            $this->currentRole
        );

        $this->tenant = $this->tenant->fresh();

        $this->dispatch('close-modal', id: 'currentlyManagingRole');
    }

    /**
     * Stop managing the role of a given user.
     */
    public function stopManagingRole(): void
    {
        $this->dispatch('close-modal', id: 'currentlyManagingRole');
    }

    /**
     * Confirm that the currently authenticated user should leave the tenant.
     */
    public function confirmLeavingTenant(): void
    {
        $this->dispatch('open-modal', id: 'confirmingLeavingTenant');
    }

    /**
     * Remove the currently authenticated user from the tenant.
     */
    public function leaveTenant(RemovesTenantEmployees $remover): Response | Redirector | RedirectResponse
    {
        $remover->remove(
            $this->user,
            $this->tenant,
            $this->user
        );

        $this->dispatch('close-modal', id: 'confirmingLeavingTenant');

        $this->tenant = $this->tenant->fresh();

        if (! Auth::user()->fresh()->hasAnyTenants() && ($tenantRegistrationUrl = Filament::getPanel(FilamentTenants::getTenantPanel())?->getTenantRegistrationUrl())) {
            return redirect($tenantRegistrationUrl);
        }

        return $this->redirectPath($remover);
    }

    /**
     * Cancel leaving the tenant.
     */
    public function cancelLeavingTenant(): void
    {
        $this->dispatch('close-modal', id: 'confirmingLeavingTenant');
    }

    /**
     * Confirm that the given tenant employee should be removed.
     */
    public function confirmTenantEmployeeRemoval(int $userId): void
    {
        $this->dispatch('open-modal', id: 'confirmingTenantEmployeeRemoval');
        $this->tenantEmployeeIdBeingRemoved = $userId;
    }

    /**
     * Remove a tenant employee from the tenant.
     */
    public function removeTenantEmployee(RemovesTenantEmployees $remover): void
    {
        $remover->remove(
            $this->user,
            $this->tenant,
            $user = FilamentTenants::findUserByIdOrFail($this->tenantEmployeeIdBeingRemoved)
        );

        $this->dispatch('close-modal', id: 'confirmingTenantEmployeeRemoval');

        $this->tenantEmployeeIdBeingRemoved = null;

        $this->tenant = $this->tenant->fresh();
    }

    /**
     * Cancel the removal of a tenant employee.
     */
    public function cancelTenantEmployeeRemoval(): void
    {
        $this->dispatch('close-modal', id: 'confirmingTenantEmployeeRemoval');
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
    {
        return Auth::user();
    }

    /**
     * Get the available tenant employee roles.
     */
    public function getRolesProperty(): array
    {
        return collect(FilamentTenants::$roles)->transform(static function ($role) {
            return with($role->jsonSerialize(), static function ($data) {
                return (new Role(
                    $data['key'],
                    $data['name'],
                    $data['permissions']
                ))->description($data['description']);
            });
        })->values()->all();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-tenants::tenants.tenant-employee-manager');
    }

    public function employeeInvitationSent($email): void
    {
        Notification::make()
            ->title(__('filament-tenants::default.notifications.tenant_invitation_sent.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-tenants::default.notifications.tenant_invitation_sent.body', compact('email'))))
            ->send();
    }
}
