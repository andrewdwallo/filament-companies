<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

use Closure;
use Wallo\FilamentCompanies\HasCompanies;
use Wallo\FilamentCompanies\Http\Livewire\CompanyEmployeeManager;
use Wallo\FilamentCompanies\Http\Livewire\DeleteCompanyForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm;

trait HasCompanyFeatures
{
    /**
     * The event listener to register.
     */
    protected static bool $switchesCurrentCompany = false;

    /**
     * Determine if the company is supporting company features.
     */
    public static bool $hasCompanyFeatures = false;

    /**
     * Determine if invitations are sent to company employees.
     */
    public static bool $sendsCompanyInvitations = false;

    /**
     * Determine if the application can update company information.
     */
    public static bool $canUpdateCompanyInformation = false;

    /**
     * Determine if the application can manage company employees.
     */
    public static bool $canManageCompanyEmployees = false;

    /**
     * Determine if the application has company deletion features.
     */
    public static bool $hasCompanyDeletionFeatures = false;

    /**
     * The component that should be used when displaying the "Update Company Name" form.
     */
    public static string $updateCompanyNameForm = UpdateCompanyNameForm::class;

    /**
     * The component that should be used when displaying the "Company Employee Manager" form.
     */
    public static string $companyEmployeeManagerForm = CompanyEmployeeManager::class;

    /**
     * The component that should be used when displaying the "Delete Company" form.
     */
    public static string $deleteCompanyForm = DeleteCompanyForm::class;

    /**
     * Determine if the application supports switching current company.
     */
    public function switchCurrentCompany(bool $condition = true): static
    {
        static::$switchesCurrentCompany = $condition;

        return $this;
    }

    /**
     * Determine if the company is supporting company features.
     */
    public function companies(bool | Closure | null $condition = true, bool $invitations = false): static
    {
        static::$hasCompanyFeatures = $condition instanceof Closure ? $condition() : $condition;
        static::$sendsCompanyInvitations = $invitations;

        return $this;
    }

    /**
     * Determine if the application supports updating company information.
     */
    public function updateCompanyInformation(bool | Closure | null $condition = true, $component = UpdateCompanyNameForm::class, int $sort = 0): static
    {
        static::$canUpdateCompanyInformation = $condition instanceof Closure ? $condition() : $condition;
        static::$updateCompanyNameForm = $component;
        static::$companyComponentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application supports managing company employees.
     */
    public function manageCompanyEmployees(bool | Closure | null $condition = true, $component = CompanyEmployeeManager::class, int $sort = 1): static
    {
        static::$canManageCompanyEmployees = $condition instanceof Closure ? $condition() : $condition;
        static::$companyEmployeeManagerForm = $component;
        static::$companyComponentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application supports company deletion.
     */
    public function companyDeletion(bool | Closure | null $condition = true, $component = DeleteCompanyForm::class, int $sort = 2): static
    {
        static::$hasCompanyDeletionFeatures = $condition instanceof Closure ? $condition() : $condition;
        static::$deleteCompanyForm = $component;
        static::$companyComponentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Get the feature specific components.
     */
    public static function getBaseCompanyComponents(): array
    {
        $components = [];

        if (static::canUpdateCompanyInformation()) {
            $components[] = static::getUpdateCompanyNameForm();
        }

        if (static::canManageCompanyEmployees()) {
            $components[] = static::getCompanyEmployeeManagerForm();
        }

        if (static::hasCompanyDeletionFeatures()) {
            $components[] = static::getDeleteCompanyForm();
        }

        return $components;
    }

    /**
     * Determine if the application switches the current company.
     */
    public static function switchesCurrentCompany(): bool
    {
        return static::$switchesCurrentCompany;
    }

    /**
     * Determine if Company is supporting company features.
     */
    public static function hasCompanyFeatures(): bool
    {
        return static::$hasCompanyFeatures;
    }

    /**
     * Determine if invitations are sent to company employees.
     */
    public static function sendsCompanyInvitations(): bool
    {
        return static::hasCompanyFeatures() && static::$sendsCompanyInvitations;
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
     * Determine if the application can update company information.
     */
    public static function canUpdateCompanyInformation(): bool
    {
        return static::$canUpdateCompanyInformation;
    }

    /**
     * Determine if the application can manage company employees.
     */
    public static function canManageCompanyEmployees(): bool
    {
        return static::$canManageCompanyEmployees;
    }

    /**
     * Determine if the application has company deletion features.
     */
    public static function hasCompanyDeletionFeatures(): bool
    {
        return static::$hasCompanyDeletionFeatures;
    }

    /**
     * Get the component that should be used when displaying the "Update Company Name" form.
     */
    public static function getUpdateCompanyNameForm(): string
    {
        return static::$updateCompanyNameForm;
    }

    /**
     * Get the component that should be used when displaying the "Company Employee Manager" form.
     */
    public static function getCompanyEmployeeManagerForm(): string
    {
        return static::$companyEmployeeManagerForm;
    }

    /**
     * Get the component that should be used when displaying the "Delete Company" form.
     */
    public static function getDeleteCompanyForm(): string
    {
        return static::$deleteCompanyForm;
    }
}
