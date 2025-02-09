<?php

namespace App\Actions\FilamentTenants;

use App\Models\Tenant;
use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Wallo\FilamentTenants\Contracts\AddsTenantEmployees;
use Wallo\FilamentTenants\Events\AddingTenantEmployee;
use Wallo\FilamentTenants\Events\TenantEmployeeAdded;
use Wallo\FilamentTenants\FilamentTenants;
use Wallo\FilamentTenants\Rules\Role;

class AddTenantEmployee implements AddsTenantEmployees
{
    /**
     * Add a new tenant employee to the given tenant.
     *
     * @throws AuthorizationException
     */
    public function add(User $user, Tenant $tenant, string $email, ?string $role = null): void
    {
        Gate::forUser($user)->authorize('addTenantEmployee', $tenant);

        $this->validate($tenant, $email, $role);

        $newTenantEmployee = FilamentTenants::findUserByEmailOrFail($email);

        AddingTenantEmployee::dispatch($tenant, $newTenantEmployee);

        $tenant->users()->attach(
            $newTenantEmployee,
            ['role' => $role]
        );

        TenantEmployeeAdded::dispatch($tenant, $newTenantEmployee);
    }

    /**
     * Validate the add employee operation.
     */
    protected function validate(Tenant $tenant, string $email, ?string $role): void
    {
        Validator::make([
            'email' => $email,
            'role' => $role,
        ], $this->rules(), [
            'email.exists' => __('filament-tenants::default.errors.email_not_found'),
        ])->after(
            $this->ensureUserIsNotAlreadyOnTenant($tenant, $email)
        )->validateWithBag('addTenantEmployee');
    }

    /**
     * Get the validation rules for adding a tenant employee.
     *
     * @return array<string, Rule|array|string>
     */
    protected function rules(): array
    {
        return array_filter([
            'email' => ['required', 'email', 'exists:users'],
            'role' => FilamentTenants::hasRoles()
                            ? ['required', 'string', new Role]
                            : null,
        ]);
    }

    /**
     * Ensure that the user is not already on the tenant.
     */
    protected function ensureUserIsNotAlreadyOnTenant(Tenant $tenant, string $email): Closure
    {
        return static function ($validator) use ($tenant, $email) {
            $validator->errors()->addIf(
                $tenant->hasUserWithEmail($email),
                'email',
                __('filament-tenants::default.errors.user_belongs_to_tenant')
            );
        };
    }
}
