<?php

namespace Wallo\FilamentCompanies\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-companies:install {stack : The development stack that should be installed (filament)}
                                              {--companies : Indicates if company support should be installed}
                                              {--socialite : Indicates if socialite support should be installed}
                                              {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the FilamentCompanies components and resources';

    /**
     * Execute the console command.
     */
    public function handle(): ?int
    {
        if ($this->argument('stack') !== 'filament') {
            $this->components->error('Invalid stack. Supported stacks are [filament].');

            return 1;
        }

        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'filament-companies-migrations', '--force' => true]);

        // Storage...
        $this->callSilent('storage:link');

        if (file_exists(resource_path('views/welcome.blade.php'))) {
            $this->replaceInFile("Route::has('login')", 'filament()->getLoginUrl()', resource_path('views/welcome.blade.php'));
            $this->replaceInFile("Route::has('register')", 'filament()->getRegistrationUrl()', resource_path('views/welcome.blade.php'));
            $this->replaceInFile('Home', '{{ ucfirst(filament()->getCurrentPanel()->getId()) }}', resource_path('views/welcome.blade.php'));
            $this->replaceInFile("{{ url('/home') }}", '{{ url(filament()->getHomeUrl()) }}', resource_path('views/welcome.blade.php'));
            $this->replaceInFile("{{ route('login') }}", '{{ url(filament()->getLoginUrl()) }}', resource_path('views/welcome.blade.php'));
            $this->replaceInFile("{{ route('register') }}", '{{ url(filament()->getRegistrationUrl()) }}', resource_path('views/welcome.blade.php'));
        }

        // Configure Session...
        $this->configureSession();

        // Install Stack...
        if ($this->argument('stack') === 'filament') {
            $this->installFilamentStack();
        }

        return 0;
    }

    /**
     * Configure the session driver for Company.
     */
    protected function configureSession(): void
    {
        if (! class_exists('CreateSessionsTable')) {
            try {
                $this->call('session:table');
            } catch (Exception $e) {
                //
            }
        }

        $this->replaceInFile("'SESSION_DRIVER', 'file'", "'SESSION_DRIVER', 'database'", config_path('session.php'));
        $this->replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env'));
        $this->replaceInFile('SESSION_DRIVER=file', 'SESSION_DRIVER=database', base_path('.env.example'));
    }

    /**
     * Install the Filament stack into the application.
     */
    protected function installFilamentStack(): bool
    {
        // Sanctum...
        (new Process([$this->phpBinary(), 'artisan', 'vendor:publish', '--provider=Laravel\Sanctum\SanctumServiceProvider', '--force'], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });

        // $this->replaceInFile("'guard' => 'web'", "'guard' => 'sanctum'", config_path('auth.php'));

        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/FilamentCompanies'));
        (new Filesystem)->ensureDirectoryExists(resource_path('markdown'));

        (new Filesystem)->deleteDirectory(resource_path('sass'));

        // Terms Of Service / Privacy Policy...
        copy(__DIR__.'/../../stubs/resources/markdown/terms.md', resource_path('markdown/terms.md'));
        copy(__DIR__.'/../../stubs/resources/markdown/policy.md', resource_path('markdown/policy.md'));

        // Service Providers...
        $this->installServiceProviderAfter('RouteServiceProvider', 'FilamentCompaniesServiceProvider');

        // Factories...
        copy(__DIR__.'/../../database/factories/UserFactory.php', base_path('database/factories/UserFactory.php'));

        // Actions...
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/CreateNewUser.php', app_path('Actions/FilamentCompanies/CreateNewUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/UpdateUserPassword.php', app_path('Actions/FilamentCompanies/UpdateUserPassword.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/UpdateUserProfileInformation.php', app_path('Actions/FilamentCompanies/UpdateUserProfileInformation.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/DeleteUser.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));

        // Routes...
        $this->replaceInFile('auth:api', 'auth:sanctum', base_path('routes/api.php'));

        // Companies...
        if ($this->option('companies')) {
            $this->installFilamentCompanyStack();
        }

        $this->line('');
        $this->components->info('Filament scaffolding installed successfully.');

        return true;
    }

    /**
     * Install the FilamentCompanies company stack into the application.
     */
    protected function installFilamentCompanyStack(): void
    {
        $this->ensureApplicationIsCompanyCompatible();

        // Socialite...
        if ($this->option('socialite')) {
            $this->installFilamentSocialiteStack();
        }
    }

    /**
     * Install the FilamentCompanies socialite stack into the application.
     */
    protected function installFilamentSocialiteStack(): void
    {
        $this->ensureApplicationIsSocialiteCompatible();
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
        copy(__DIR__.'/../../stubs/app/Providers/FilamentCompaniesServiceProvider.php', app_path('Providers/FilamentCompaniesServiceProvider.php'));

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/Employeeship.php', app_path('Models/Employeeship.php'));
        copy(__DIR__.'/../../stubs/app/Models/Company.php', app_path('Models/Company.php'));
        copy(__DIR__.'/../../stubs/app/Models/CompanyInvitation.php', app_path('Models/CompanyInvitation.php'));
        copy(__DIR__.'/../../stubs/app/Models/User.php', app_path('Models/User.php'));

        // FilamentCompanies Actions...
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/AddCompanyEmployee.php', app_path('Actions/FilamentCompanies/AddCompanyEmployee.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/CreateCompany.php', app_path('Actions/FilamentCompanies/CreateCompany.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/DeleteCompany.php', app_path('Actions/FilamentCompanies/DeleteCompany.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/DeleteUser.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/InviteCompanyEmployee.php', app_path('Actions/FilamentCompanies/InviteCompanyEmployee.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/RemoveCompanyEmployee.php', app_path('Actions/FilamentCompanies/RemoveCompanyEmployee.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/UpdateCompanyName.php', app_path('Actions/FilamentCompanies/UpdateCompanyName.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/CreateNewUser.php', app_path('Actions/FilamentCompanies/CreateNewUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/UpdateUserPassword.php', app_path('Actions/FilamentCompanies/UpdateUserPassword.php'));

        // Policies...
        copy(__DIR__.'/../../stubs/app/Policies/CompanyPolicy.php', app_path('Policies/CompanyPolicy.php'));

        // Factories...
        copy(__DIR__.'/../../database/factories/UserFactory.php', base_path('database/factories/UserFactory.php'));
        copy(__DIR__.'/../../database/factories/CompanyFactory.php', base_path('database/factories/CompanyFactory.php'));
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
        copy(__DIR__.'/../../stubs/app/Providers/FilamentCompaniesWithSocialiteServiceProvider.php', app_path('Providers/FilamentCompaniesServiceProvider.php'));

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/UserWithSocialite.php', app_path('Models/User.php'));
        copy(__DIR__.'/../../stubs/app/Models/ConnectedAccount.php', app_path('Models/ConnectedAccount.php'));

        // Actions...
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/DeleteUserWithSocialite.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/CreateConnectedAccount.php', app_path('Actions/FilamentCompanies/CreateConnectedAccount.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/CreateUserFromProvider.php', app_path('Actions/FilamentCompanies/CreateUserFromProvider.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/HandleInvalidState.php', app_path('Actions/FilamentCompanies/HandleInvalidState.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/ResolveSocialiteUser.php', app_path('Actions/FilamentCompanies/ResolveSocialiteUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/SetUserPassword.php', app_path('Actions/FilamentCompanies/SetUserPassword.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/UpdateConnectedAccount.php', app_path('Actions/FilamentCompanies/UpdateConnectedAccount.php'));

        // Policies...
        copy(__DIR__.'/../../stubs/app/Policies/ConnectedAccountPolicy.php', app_path('Policies/ConnectedAccountPolicy.php'));
    }

    /**
     * Install the service provider in the application configuration file.
     */
    protected function installServiceProviderAfter(string $after, string $name): void
    {
        if (! Str::contains($appConfig = file_get_contents(config_path('app.php')), 'App\\Providers\\'.$name.'::class')) {
            file_put_contents(config_path('app.php'), str_replace(
                'App\\Providers\\'.$after.'::class,',
                'App\\Providers\\'.$after.'::class,'.PHP_EOL.'        App\\Providers\\'.$name.'::class,',
                $appConfig
            ));
        }
    }

    /**
     * Removes the given Composer Packages as "dev" dependencies.
     */
    protected function removeComposerDevPackages(mixed $packages): bool
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = [$this->phpBinary(), $composer, 'remove', '--dev'];
        }

        $command = [...$command ?? ['composer', 'remove', '--dev'], ...is_array($packages) ? $packages : func_get_args()];

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            }) === 0;
    }

    /**
     * Install the given Composer Packages as "dev" dependencies.
     */
    protected function requireComposerDevPackages(mixed $packages): bool
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = [$this->phpBinary(), $composer, 'require', '--dev'];
        }

        $command = [...$command ?? ['composer', 'require', '--dev'], ...is_array($packages) ? $packages : func_get_args()];

        return (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            }) === 0;
    }

    /**
     * Replace a given string within a given file.
     */
    protected function replaceInFile(string $search, string $replace, string $path): void
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    /**
     * Get the path to the appropriate PHP binary.
     */
    protected function phpBinary(): false|string
    {
        return (new PhpExecutableFinder())->find(false) ?: 'php';
    }
}
