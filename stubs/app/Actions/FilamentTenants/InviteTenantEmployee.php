<?php

namespace App\Actions\FilamentTenants;

use App\Models\Tenant;
use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Wallo\FilamentTenants\Contracts\InvitesTenantEmployees;
use Wallo\FilamentTenants\Events\InvitingTenantEmployee;
use Wallo\FilamentTenants\FilamentTenants;
use Wallo\FilamentTenants\Mail\TenantInvitation;
use Wallo\FilamentTenants\Rules\Role;

class InviteTenantEmployee implements InvitesTenantEmployees
{
    /**
     * Invite a new tenant employee to the given tenant.
     *
     * @throws AuthorizationException
     */
    public function invite(User $user, Tenant $tenant, string $email, ?string $role = null): void
    {
        Gate::forUser($user)->authorize('addTenantEmployee', $tenant);

        $this->validate($tenant, $email, $role);

        InvitingTenantEmployee::dispatch($tenant, $email, $role);

        $invitation = $tenant->tenantInvitations()->create([
            'email' => $email,
            'role' => $role,
        ]);

        Mail::to($email)->send(new TenantInvitation($invitation));
    }

    /**
     * Validate the invite employee operation.
     */
    protected function validate(Tenant $tenant, string $email, ?string $role): void
    {
        Validator::make([
            'email' => $email,
            'role' => $role,
        ], $this->rules($tenant), [
            'email.unique' => __('filament-tenants::default.errors.employee_already_invited'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnTenant($tenant, $email)
        )->validateWithBag('addTenantEmployee');
    }

    /**
     * Get the validation rules for inviting a tenant employee.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function rules(Tenant $tenant): array
    {
        return array_filter([
            'email' => [
                'required', 'email',
                Rule::unique('tenant_invitations')->where(static function (Builder $query) use ($tenant) {
                    $query->where('tenant_id', $tenant->id);
                }),
            ],
            'role' => FilamentTenants::hasRoles()
                            ? ['required', 'string', new Role]
                            : null,
        ]);
    }

    /**
     * Ensure that the employee is not already on the tenant.
     */
    protected function ensureUserIsNotAlreadyOnTenant(Tenant $tenant, string $email): Closure
    {
        return static function ($validator) use ($tenant, $email) {
            $validator->errors()->addIf(
                $tenant->hasUserWithEmail($email),
                'email',
                __('filament-tenants::default.errors.employee_already_belongs_to_tenant')
            );
        };
    }
}
