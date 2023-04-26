<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Wallo\FilamentCompanies\Actions\UpdateCompanyEmployeeRole;
use Wallo\FilamentCompanies\Contracts\AddsCompanyEmployees;
use Wallo\FilamentCompanies\Contracts\InvitesCompanyEmployees;
use Wallo\FilamentCompanies\Contracts\RemovesCompanyEmployees;
use Wallo\FilamentCompanies\Features;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\RedirectsActions;
use Wallo\FilamentCompanies\Role;

class CompanyEmployeeManager extends Component
{
    use RedirectsActions;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * Indicates if a user's role is currently being managed.
     */
    public bool $currentlyManagingRole = false;

    /**
     * The user that is having their role managed.
     */
    public mixed $managingRoleFor;

    /**
     * The current role for the user that is having their role managed.
     */
    public string $currentRole;

    /**
     * Indicates if the application is confirming if a user wishes to leave the current company.
     */
    public bool $confirmingLeavingCompany = false;

    /**
     * Indicates if the application is confirming if a company employee should be removed.
     */
    public bool $confirmingCompanyEmployeeRemoval = false;

    /**
     * The ID of the company employee being removed.
     */
    public int|null $companyEmployeeIdBeingRemoved = null;

    /**
     * The "add company employee" form state.
     *
     * @var array<string, mixed>
     */
    public $addCompanyEmployeeForm = [
        'email' => '',
        'role' => null,
    ];

    /**
     * Mount the component.
     */
    public function mount(mixed $company): void
    {
        $this->company = $company;
    }

    /**
     * Add a new company employee to a company.
     */
    public function addCompanyEmployee(): void
    {
        $this->resetErrorBag();

        if (Features::sendsCompanyInvitations()) {
            app(InvitesCompanyEmployees::class)->invite(
                $this->user,
                $this->company,
                $this->addCompanyEmployeeForm['email'],
                $this->addCompanyEmployeeForm['role']
            );
        } else {
            app(AddsCompanyEmployees::class)->add(
                $this->user,
                $this->company,
                $this->addCompanyEmployeeForm['email'],
                $this->addCompanyEmployeeForm['role']
            );
        }

        $email = $this->addCompanyEmployeeForm['email'];

        $this->employeeInvitationSent($email);

        $this->addCompanyEmployeeForm = [
            'email' => '',
            'role' => null,
        ];

        $this->company = $this->company->fresh();
    }

    /**
     * Cancel a pending company employee invitation.
     */
    public function cancelCompanyInvitation(int $invitationId): void
    {
        if (! empty($invitationId)) {
            $model = FilamentCompanies::companyInvitationModel();

            $model::whereKey($invitationId)->delete();
        }

        $this->company = $this->company->fresh();
    }

    /**
     * Allow the given user's role to be managed.
     */
    public function manageRole(int $userId): void
    {
        $this->currentlyManagingRole = true;
        $this->managingRoleFor = FilamentCompanies::findUserByIdOrFail($userId);
        $this->currentRole = $this->managingRoleFor->companyRole($this->company)->key;
    }

    /**
     * Save the role for the user being managed.
     *
     * @throws AuthorizationException
     */
    public function updateRole(UpdateCompanyEmployeeRole $updater): void
    {
        $updater->update(
            $this->user,
            $this->company,
            $this->managingRoleFor->id,
            $this->currentRole
        );

        $this->company = $this->company->fresh();

        $this->stopManagingRole();
    }

    /**
     * Stop managing the role of a given user.
     */
    public function stopManagingRole(): void
    {
        $this->currentlyManagingRole = false;
    }

    /**
     * Remove the currently authenticated user from the company.
     */
    public function leaveCompany(RemovesCompanyEmployees $remover): Response|Redirector|RedirectResponse
    {
        $remover->remove(
            $this->user,
            $this->company,
            $this->user
        );

        $this->confirmingLeavingCompany = false;

        $this->company = $this->company->fresh();

        return $this->redirectPath($remover);
    }

    /**
     * Confirm that the given company employee should be removed.
     */
    public function confirmCompanyEmployeeRemoval(int $userId): void
    {
        $this->confirmingCompanyEmployeeRemoval = true;

        $this->companyEmployeeIdBeingRemoved = $userId;
    }

    /**
     * Remove a company employee from the company.
     */
    public function removeCompanyEmployee(RemovesCompanyEmployees $remover): void
    {
        $remover->remove(
            $this->user,
            $this->company,
            $user = FilamentCompanies::findUserByIdOrFail($this->companyEmployeeIdBeingRemoved)
        );

        $this->confirmingCompanyEmployeeRemoval = false;

        $this->companyEmployeeIdBeingRemoved = null;

        $this->company = $this->company->fresh();
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * Get the available company employee roles.
     */
    public function getRolesProperty(): array
    {
        return collect(FilamentCompanies::$roles)->transform(static function ($role) {
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
        return view('filament-companies::companies.company-employee-manager');
    }

    public function employeeInvitationSent($email): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.company_invitation_sent.title'))
            ->success()
            ->body(__('filament-companies::default.notifications.company_invitation_sent.body', compact('email')))
            ->send();
    }
}
