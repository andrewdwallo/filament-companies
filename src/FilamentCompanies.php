<?php

namespace Wallo\FilamentCompanies;

use App\Models\Company;
use App\Models\CompanyInvitation;
use App\Models\Employeeship;
use App\Models\User;
use Closure;
use Filament\Contracts\Plugin;
use Filament\Events\TenantSet;
use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Contracts\AddsCompanyEmployees;
use Wallo\FilamentCompanies\Contracts\CreatesCompanies;
use Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\CreatesNewUsers;
use Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Wallo\FilamentCompanies\Contracts\DeletesCompanies;
use Wallo\FilamentCompanies\Contracts\DeletesUsers;
use Wallo\FilamentCompanies\Contracts\HandlesInvalidState;
use Wallo\FilamentCompanies\Contracts\InvitesCompanyEmployees;
use Wallo\FilamentCompanies\Contracts\RemovesCompanyEmployees;
use Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\UpdatesUserPasswords;
use Wallo\FilamentCompanies\Contracts\UpdatesUserProfileInformation;
use Wallo\FilamentCompanies\Http\Controllers\OAuthController;
use Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm;
use Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentCompanies\Http\Livewire\SetPasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm;
use Wallo\FilamentCompanies\Listeners\SwitchCurrentCompany;
use Wallo\FilamentCompanies\Pages\Company\CompanySettings;
use Wallo\FilamentCompanies\Pages\Company\CreateCompany;

class FilamentCompanies implements Plugin
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
     * The user panel.
     */
    public static string|null $userPanel = null;

    /**
     * The configuration for the modals.
     */
    public static array $modals = [];

    /**
     * The user model that should be used by Company.
     */
    public static string $userModel = User::class;

    /**
     * The company model that should be used by Company.
     */
    public static string $companyModel = Company::class;

    /**
     * The employeeship model that should be used by Company.
     */
    public static string $employeeshipModel = Employeeship::class;

    /**
     * The company invitation model that should be used by Company.
     */
    public static string $companyInvitationModel = CompanyInvitation::class;

    public static array $addedProfileComponents = [];

    public static array $componentSortOrder = [];

    /**
     * The socialite configuration.
     */
    protected Socialite $socialite;

    /**
     * The features' configuration.
     */
    protected Features $features;

    /**
     * Create new instances.
     */
    public function __construct()
    {
        $this->socialite = new Socialite();
        $this->features = new Features();
    }

    /**
     * Get the user panel.
     */
    public function userPanel(string $panel): static
    {
        static::$userPanel = $panel;

        return $this;
    }

    /**
     * Get the modals' configuration.
     */
    public function modals(string $width = '2xl', string $alignment = 'center', string $formActionsAlignment = 'center', bool $cancelButtonAction = false): static
    {
        static::$modals = compact('width', 'alignment', 'formActionsAlignment', 'cancelButtonAction');

        return $this;
    }

    /**
     * Determine if the application supports switching current company.
     */
    public function switchCurrentCompany(bool $condition = true): static
    {
        $this->features->switchCurrentCompany($condition);

        return $this;
    }

    /**
     * Get the panel where the plugin is registered.
     */
    public static function getCompanyPanel(): string|null
    {
        foreach (Filament::getPanels() as $panel) {
            if ($panel->hasPlugin('companies')) {
                return $panel->getId();
            }
        }

        return null;
    }

    /**
     * Get the user panel configuration.
     */
    public static function getUserPanel(): string
    {
        return static::$userPanel;
    }

    /**
     * Get the modals' configuration.
     */
    public static function getModals(): array
    {
        return static::$modals;
    }

    public static function hasUserPanel(): bool
    {
        return static::$userPanel !== null;
    }

    /**
     * Determine if the application supports updating profile information.
     */
    public function updateProfileInformation(bool|Closure|null $condition = true, $component = UpdateProfileInformationForm::class, int $sort = 0): static
    {
        $this->features->updateProfileInformation($condition, $component, $sort);

        return $this;
    }

    /**
     * Determine if the application supports updating passwords.
     */
    public function updatePasswords(bool|Closure|null $condition = true, $component = UpdatePasswordForm::class, int $sort = 1): static
    {
        $this->features->updatePasswords($condition, $component, $sort);

        return $this;
    }

    public function setPasswords(bool|Closure|null $condition = true, $component = SetPasswordForm::class, int $sort = 2): static
    {
        $this->socialite->setPasswords($condition, $component, $sort);

        return $this;
    }

    public function connectedAccounts(bool|Closure|null $condition = true, $component = ConnectedAccountsForm::class, int $sort = 3): static
    {
        $this->socialite->connectedAccounts($condition, $component, $sort);

        return $this;
    }

    /**
     * Determine if the application supports managing browser sessions.
     */
    public function manageBrowserSessions(bool|Closure|null $condition = true, $component = LogoutOtherBrowserSessionsForm::class, int $sort = 4): static
    {
        $this->features->manageBrowserSessions($condition, $component, $sort);

        return $this;
    }

    /**
     * Determine if the application supports the Account Deletion features.
     */
    public function accountDeletion(bool|Closure|null $condition = true, $component = DeleteUserForm::class, int $sort = 5): static
    {
        $this->features->accountDeletion($condition, $component, $sort);

        return $this;
    }

    public function addProfileComponents(array $componentsWithSortOrder): static
    {
        foreach ($componentsWithSortOrder as $sort => $component) {
            static::$addedProfileComponents[] = $component;
            static::$componentSortOrder[$component] = $sort;
        }

        return $this;
    }

    /**
     * Determine if the application supports socialite.
     */
    public function socialite(bool|Closure|null $condition = true, array|null $providers = null, array|null $features = null): static
    {
        $this->socialite
            ->enableSocialite($condition)
            ->setProviders($providers)
            ->setFeatures($features);

        return $this;
    }

    /**
     * Determine if the application supports the profile photos feature.
     */
    public function profilePhotos(bool|Closure|null $condition = true, string $disk = 'public', string $storagePath = 'profile-photos'): static
    {
        $this->features->profilePhotos($condition, $disk, $storagePath);

        return $this;
    }

    /**
     * Determine if the application supports the api feature.
     */
    public function api(bool|Closure|null $condition = true): static
    {
        $this->features->api($condition);

        return $this;
    }

    /**
     * Determine if the application supports the companies features.
     */
    public function companies(bool|Closure|null $condition = true, bool $invitations = false): static
    {
        $this->features->companies($condition, $invitations);

        return $this;
    }

    /**
     * Determine if the application supports the Terms and Privacy Policy features.
     */
    public function termsAndPrivacyPolicy(bool|Closure|null $condition = true): static
    {
        $this->features->termsAndPrivacyPolicy($condition);

        return $this;
    }

    /**
     * Determine if the application supports notifications.
     */
    public function notifications(bool|Closure|null $condition = true): static
    {
        $this->features->notifications($condition);

        return $this;
    }

    /**
     * Get the added profile page components.
     */
    public static function getAddedProfileComponents(): array
    {
        return static::$addedProfileComponents;
    }

    /**
     * Get the profile page components.
     */
    public static function getProfileComponents(): array
    {
        $featureComponents = Features::getComponents();
        $socialiteComponents = Socialite::getComponents();
        $addedComponents = static::getAddedProfileComponents();

        $components = [...$featureComponents, ...$socialiteComponents, ...$addedComponents];

        $sortOrder = [...Features::$componentSortOrder, ...Socialite::$componentSortOrder, ...static::$componentSortOrder];

        uasort($components, static function ($a, $b) use ($sortOrder) {
            return $sortOrder[$a] <=> $sortOrder[$b];
        });

        return $components;
    }

    public function getId(): string
    {
        return 'companies';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        if (Features::hasCompanyFeatures()) {
            Livewire::component('filament.pages.companies.create_company', CreateCompany::class);
            Livewire::component('filament.pages.companies.company_settings', CompanySettings::class);
        }

        if (Socialite::hasSocialiteFeatures()) {
            app()->bind(OAuthController::class, static function (Application $app) {
                return new OAuthController(
                    $app->make(CreatesUserFromProvider::class),
                    $app->make(CreatesConnectedAccounts::class),
                    $app->make(UpdatesConnectedAccounts::class),
                    $app->make(HandlesInvalidState::class),
                );
            });
        }
    }

    public function boot(Panel $panel): void
    {
        if (Features::switchesCurrentCompany()) {
            Event::listen(TenantSet::class, SwitchCurrentCompany::class);
        }
    }

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
     * Register a class / callback that should be used to create new users.
     */
    public static function createUsersUsing(string $class): void
    {
        app()->singleton(CreatesNewUsers::class, $class);
    }

    /**
     * Register a class / callback that should be used to update user profile information.
     */
    public static function updateUserProfileInformationUsing(string $class): void
    {
        app()->singleton(UpdatesUserProfileInformation::class, $class);
    }

    /**
     * Register a class / callback that should be used to update user passwords.
     */
    public static function updateUserPasswordsUsing(string $class): void
    {
        app()->singleton(UpdatesUserPasswords::class, $class);
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
