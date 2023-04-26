<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Support\Arr;
use Wallo\FilamentCompanies\Contracts\AddsCompanyEmployees;
use Wallo\FilamentCompanies\Contracts\CreatesCompanies;
use Wallo\FilamentCompanies\Contracts\DeletesCompanies;
use Wallo\FilamentCompanies\Contracts\DeletesUsers;
use Wallo\FilamentCompanies\Contracts\InvitesCompanyEmployees;
use Wallo\FilamentCompanies\Contracts\RemovesCompanyEmployees;
use Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames;

class FilamentCompanies
{
    /**
     * Indicates if Company routes will be registered.
     */
    public static bool $registersRoutes = true;

    /**
     * The roles that are available to assign to users.
     */
    public static array $roles = [];

    /**
     * The permissions that exist within the application.
     */
    public static array $permissions = [];

    /**
     * The default permissions that should be available to new entities.
     */
    public static array $defaultPermissions = [];

    /**
     * The user model that should be used by Company.
     */
    public static string $userModel = 'App\\Models\\User';

    /**
     * The company model that should be used by Company.
     */
    public static string $companyModel = 'App\\Models\\Company';

    /**
     * The employeeship model that should be used by Company.
     */
    public static string $employeeshipModel = 'App\\Models\\Employeeship';

    /**
     * The company invitation model that should be used by Company.
     */
    public static string $companyInvitationModel = 'App\\Models\\CompanyInvitation';

    /**
     * Determine if Company has registered roles.
     */
    public static function hasRoles(): bool
    {
        return count(static::$roles) > 0;
    }

    /**
     * Find the role with the given key.
     */
    public static function findRole(string $key): Role|null
    {
        return static::$roles[$key] ?? null;
    }

    /**
     * Define a role.
     */
    public static function role(string $key, string $name, array $permissions): Role
    {
        static::$permissions = collect([...static::$permissions, ...$permissions])
                                    ->unique()
                                    ->sort()
                                    ->values()
                                    ->all();

        return tap(new Role($key, $name, $permissions), static function ($role) use ($key) {
            static::$roles[$key] = $role;
        });
    }

    /**
     * Determine if any permissions have been registered with Company.
     */
    public static function hasPermissions(): bool
    {
        return count(static::$permissions) > 0;
    }

    /**
     * Define the available API token permissions.
     */
    public static function permissions(array $permissions): static
    {
        static::$permissions = $permissions;

        return new static;
    }

    /**
     * Define the default permissions that should be available to new API tokens.
     */
    public static function defaultApiTokenPermissions(array $permissions): static
    {
        static::$defaultPermissions = $permissions;

        return new static;
    }

    /**
     * Return the permissions in the given list that are actually defined permissions for the application.
     */
    public static function validPermissions(array $permissions): array
    {
        return array_values(array_intersect($permissions, static::$permissions));
    }

    /**
     * Determine if Company is managing profile photos.
     */
    public static function managesProfilePhotos(): bool
    {
        return Features::managesProfilePhotos();
    }

    /**
     * Determine if Company is supporting API features.
     */
    public static function hasApiFeatures(): bool
    {
        return Features::hasApiFeatures();
    }

    /**
     * Determine if Company is supporting company features.
     */
    public static function hasCompanyFeatures(): bool
    {
        return Features::hasCompanyFeatures();
    }

    /**
     * Determine if a given user model utilizes the "HasCompanies" trait.
     */
    public static function userHasCompanyFeatures(mixed $user): bool
    {
        return (array_key_exists(HasCompanies::class, class_uses_recursive($user)) ||
                method_exists($user, 'currentCompany')) &&
                static::hasCompanyFeatures();
    }

    /**
     * Determine if the application is using the terms confirmation feature.
     */
    public static function hasTermsAndPrivacyPolicyFeature(): bool
    {
        return Features::hasTermsAndPrivacyPolicyFeature();
    }

    /**
     * Determine if the application is using any account deletion features.
     */
    public static function hasAccountDeletionFeatures(): bool
    {
        return Features::hasAccountDeletionFeatures();
    }

    /**
     * Find a user instance by the given ID.
     */
    public static function findUserByIdOrFail(int $id): mixed
    {
        return static::newUserModel()->where('id', $id)->firstOrFail();
    }

    /**
     * Find a user instance by the given email address or fail.
     */
    public static function findUserByEmailOrFail(string $email): mixed
    {
        return static::newUserModel()->where('email', $email)->firstOrFail();
    }

    /**
     * Get the name of the user model used by the application.
     */
    public static function userModel(): string
    {
        return static::$userModel;
    }

    /**
     * Get a new instance of the user model.
     */
    public static function newUserModel(): mixed
    {
        $model = static::userModel();

        return new $model;
    }

    /**
     * Specify the user model that should be used by Company.
     */
    public static function useUserModel(string $model): static
    {
        static::$userModel = $model;

        return new static;
    }

    /**
     * Get the name of the company model used by the application.
     */
    public static function companyModel(): string
    {
        return static::$companyModel;
    }

    /**
     * Get a new instance of the company model.
     */
    public static function newCompanyModel(): mixed
    {
        $model = static::companyModel();

        return new $model;
    }

    /**
     * Specify the company model that should be used by Company.
     */
    public static function useCompanyModel(string $model): static
    {
        static::$companyModel = $model;

        return new static;
    }

    /**
     * Get the name of the employeeship model used by the application.
     */
    public static function employeeshipModel(): string
    {
        return static::$employeeshipModel;
    }

    /**
     * Specify the employeeship model that should be used by Company.
     */
    public static function useEmployeeshipModel(string $model): static
    {
        static::$employeeshipModel = $model;

        return new static;
    }

    /**
     * Get the name of the company invitation model used by the application.
     */
    public static function companyInvitationModel(): string
    {
        return static::$companyInvitationModel;
    }

    /**
     * Specify the company invitation model that should be used by Company.
     */
    public static function useCompanyInvitationModel(string $model): static
    {
        static::$companyInvitationModel = $model;

        return new static;
    }

    /**
     * Register a class / callback that should be used to create companies.
     */
    public static function createCompaniesUsing(string $class): void
    {
        app()->singleton(CreatesCompanies::class, $class);
    }

    /**
     * Register a class / callback that should be used to update company names.
     */
    public static function updateCompanyNamesUsing(string $class): void
    {
        app()->singleton(UpdatesCompanyNames::class, $class);
    }

    /**
     * Register a class / callback that should be used to add company employees.
     */
    public static function addCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(AddsCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to add company employees.
     */
    public static function inviteCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(InvitesCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to remove company employees.
     */
    public static function removeCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(RemovesCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete companies.
     */
    public static function deleteCompaniesUsing(string $class): void
    {
        app()->singleton(DeletesCompanies::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete users.
     */
    public static function deleteUsersUsing(string $class): void
    {
        app()->singleton(DeletesUsers::class, $class);
    }

    /**
     * Find the path to a localized Markdown resource.
     */
    public static function localizedMarkdownPath(string $name): string|null
    {
        $localName = preg_replace('#(\.md)$#i', '.'.app()->getLocale().'$1', $name);

        return Arr::first([
            resource_path('markdown/'.$localName),
            resource_path('markdown/'.$name),
        ], static function ($path) {
            return file_exists($path);
        });
    }

    /**
     * Configure Company to not register its routes.
     */
    public static function ignoreRoutes(): static
    {
        static::$registersRoutes = false;

        return new static;
    }
}
