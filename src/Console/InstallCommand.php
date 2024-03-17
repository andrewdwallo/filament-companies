<?php

namespace Wallo\FilamentCompanies\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\select;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-companies:install {--socialite : Install with Socialite support} {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Install the Filament Companies package';

    private bool $withSocialite = false;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->withSocialite = $this->option('socialite');
        $force = $this->option('force');

        if (! $force && File::exists(app_path('Providers/FilamentCompaniesServiceProvider.php'))) {
            $shouldProceed = confirm(
                label: 'Filament Companies is already installed. Do you want to continue?',
                default: false,
                yes: 'Yes, I want to continue',
                no: 'No, exit',
                hint: 'By continuing, some files may be overwritten.',
            );

            if (! $shouldProceed) {
                info('Filament Companies installation aborted.');

                return static::FAILURE;
            }
        }

        if (! $this->withSocialite) {
            $installationType = select(
                label: 'Which installation type would you like to use?',
                options: [
                    'base' => 'Base Package',
                    'socialite' => 'With Socialite Support',
                ],
                default: 'base',
            );

            if ($installationType === 'socialite') {
                $this->withSocialite = true;
            }
        }

        info('Installing Filament Companies...');

        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'filament-companies-migrations', '--force' => true]);

        // Storage...
        $this->callSilent('storage:link');

        // Update Welcome Page...
        $this->updateWelcomePage();

        // Configure Session...
        $this->configureSession();

        // Install Filament Companies...
        $this->prepareForInstallation();

        return static::SUCCESS;
    }

    /**
     * Update the default welcome page.
     */
    protected function updateWelcomePage(): void
    {
        $filePath = resource_path('views/welcome.blade.php');

        if (file_exists($filePath)) {
            $fileContents = file_get_contents($filePath);

            $alreadyExists = Str::contains($fileContents, 'filament()->getHomeUrl()');

            if ($alreadyExists) {
                return;
            }

            $this->replaceInFile("Route::has('login')", 'filament()->getLoginUrl()', $filePath);
            $this->replaceInFile("Route::has('register')", 'filament()->getRegistrationUrl()', $filePath);
            $this->replaceInFile('Dashboard', '{{ ucfirst(filament()->getCurrentPanel()->getId()) }}', $filePath);
            $this->replaceInFile("{{ url('/dashboard') }}", '{{ url(filament()->getHomeUrl()) }}', $filePath);
            $this->replaceInFile("{{ route('login') }}", '{{ url(filament()->getLoginUrl()) }}', $filePath);
            $this->replaceInFile("{{ route('register') }}", '{{ url(filament()->getRegistrationUrl()) }}', $filePath);
        }
    }

    /**
     * Configure the session driver for Company.
     */
    protected function configureSession(): void
    {
        $this->replaceInFile('SESSION_DRIVER=cookie', 'SESSION_DRIVER=database', base_path('.env'));
        $this->replaceInFile('SESSION_DRIVER=cookie', 'SESSION_DRIVER=database', base_path('.env.example'));
    }

    /**
     * Install the Filament stack into the application.
     */
    protected function prepareForInstallation(): bool
    {
        // Sanctum...
        $this->call('install:api', [
            '--without-migration-prompt' => true,
        ]);

        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/FilamentCompanies'));
        (new Filesystem)->ensureDirectoryExists(resource_path('markdown'));

        (new Filesystem)->deleteDirectory(resource_path('sass'));

        // Terms Of Service / Privacy Policy...
        copy(__DIR__ . '/../../stubs/resources/markdown/terms.md', resource_path('markdown/terms.md'));
        copy(__DIR__ . '/../../stubs/resources/markdown/policy.md', resource_path('markdown/policy.md'));

        // Factories...
        copy(__DIR__ . '/../../database/factories/UserFactory.php', base_path('database/factories/UserFactory.php'));

        // Actions...
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/CreateNewUser.php', app_path('Actions/FilamentCompanies/CreateNewUser.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/UpdateUserPassword.php', app_path('Actions/FilamentCompanies/UpdateUserPassword.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/UpdateUserProfileInformation.php', app_path('Actions/FilamentCompanies/UpdateUserProfileInformation.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/DeleteUser.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));

        // Companies...
        $this->installFilamentCompanies();

        return true;
    }

    /**
     * Install the FilamentCompanies company stack into the application.
     */
    protected function installFilamentCompanies(): void
    {
        $this->ensureApplicationIsCompanyCompatible();

        // Socialite...
        if ($this->withSocialite) {
            $this->ensureApplicationIsSocialiteCompatible();
            info('Filament Companies with Socialite support installed successfully.');
        } else {
            info('Filament Companies installed successfully.');
        }
    }

    /**
     * Ensure the installed user model is ready for company usage.
     */
    protected function ensureApplicationIsCompanyCompatible(): void
    {
        // Publish FilamentCompanies Company Migrations...
        $this->callSilent('vendor:publish', ['--tag' => 'filament-companies-company-migrations', '--force' => true]);

        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/FilamentCompanies'));
        (new Filesystem)->ensureDirectoryExists(app_path('Events'));
        (new Filesystem)->ensureDirectoryExists(app_path('Policies'));

        // Service Providers...
        copy(__DIR__ . '/../../stubs/app/Providers/FilamentCompaniesServiceProvider.php', app_path('Providers/FilamentCompaniesServiceProvider.php'));
        ServiceProvider::addProviderToBootstrapFile('App\Providers\FilamentCompaniesServiceProvider');

        // Models...
        copy(__DIR__ . '/../../stubs/app/Models/Employeeship.php', app_path('Models/Employeeship.php'));
        copy(__DIR__ . '/../../stubs/app/Models/Company.php', app_path('Models/Company.php'));
        copy(__DIR__ . '/../../stubs/app/Models/CompanyInvitation.php', app_path('Models/CompanyInvitation.php'));
        copy(__DIR__ . '/../../stubs/app/Models/User.php', app_path('Models/User.php'));

        // FilamentCompanies Actions...
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/AddCompanyEmployee.php', app_path('Actions/FilamentCompanies/AddCompanyEmployee.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/CreateCompany.php', app_path('Actions/FilamentCompanies/CreateCompany.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/DeleteCompany.php', app_path('Actions/FilamentCompanies/DeleteCompany.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/DeleteUser.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/InviteCompanyEmployee.php', app_path('Actions/FilamentCompanies/InviteCompanyEmployee.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/RemoveCompanyEmployee.php', app_path('Actions/FilamentCompanies/RemoveCompanyEmployee.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/UpdateCompanyName.php', app_path('Actions/FilamentCompanies/UpdateCompanyName.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/CreateNewUser.php', app_path('Actions/FilamentCompanies/CreateNewUser.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/UpdateUserPassword.php', app_path('Actions/FilamentCompanies/UpdateUserPassword.php'));

        // Policies...
        copy(__DIR__ . '/../../stubs/app/Policies/CompanyPolicy.php', app_path('Policies/CompanyPolicy.php'));

        // Factories...
        copy(__DIR__ . '/../../database/factories/UserFactory.php', base_path('database/factories/UserFactory.php'));
        copy(__DIR__ . '/../../database/factories/CompanyFactory.php', base_path('database/factories/CompanyFactory.php'));
    }

    protected function ensureApplicationIsSocialiteCompatible(): void
    {
        // Publish FilamentCompanies Socialite Migrations...
        $this->callSilent('vendor:publish', ['--tag' => 'filament-companies-socialite-migrations', '--force' => true]);

        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/FilamentCompanies'));
        (new Filesystem)->ensureDirectoryExists(app_path('Events'));
        (new Filesystem)->ensureDirectoryExists(app_path('Policies'));

        // Service Providers...
        copy(__DIR__ . '/../../stubs/app/Providers/FilamentCompaniesWithSocialiteServiceProvider.php', app_path('Providers/FilamentCompaniesServiceProvider.php'));

        // Models...
        copy(__DIR__ . '/../../stubs/app/Models/UserWithSocialite.php', app_path('Models/User.php'));
        copy(__DIR__ . '/../../stubs/app/Models/ConnectedAccount.php', app_path('Models/ConnectedAccount.php'));

        // Actions...
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/DeleteUserWithSocialite.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/CreateConnectedAccount.php', app_path('Actions/FilamentCompanies/CreateConnectedAccount.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/CreateUserFromProvider.php', app_path('Actions/FilamentCompanies/CreateUserFromProvider.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/HandleInvalidState.php', app_path('Actions/FilamentCompanies/HandleInvalidState.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/ResolveSocialiteUser.php', app_path('Actions/FilamentCompanies/ResolveSocialiteUser.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/SetUserPassword.php', app_path('Actions/FilamentCompanies/SetUserPassword.php'));
        copy(__DIR__ . '/../../stubs/app/Actions/FilamentCompanies/UpdateConnectedAccount.php', app_path('Actions/FilamentCompanies/UpdateConnectedAccount.php'));

        // Policies...
        copy(__DIR__ . '/../../stubs/app/Policies/ConnectedAccountPolicy.php', app_path('Policies/ConnectedAccountPolicy.php'));
    }

    /**
     * Replace a given string within a given file.
     */
    protected function replaceInFile(string $search, string $replace, string $path): void
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
