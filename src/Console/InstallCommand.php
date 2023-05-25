<?php

namespace Wallo\FilamentCompanies\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use JsonException;
use RuntimeException;
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
                                              {--api : Indicates if API support should be installed}
                                              {--verification : Indicates if email verification support should be installed}
                                              {--pest : Indicates if Pest should be installed}
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
        $this->callSilent('vendor:publish', ['--tag' => 'filament-companies-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'filament-companies-migrations', '--force' => true]);

        $this->callSilent('vendor:publish', ['--tag' => 'fortify-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-support', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'fortify-migrations', '--force' => true]);

        // Storage...
        $this->callSilent('storage:link');

        // "Home" Route...
        $this->replaceInFile('/home', '', app_path('Providers/RouteServiceProvider.php'));

        if (file_exists(resource_path('views/welcome.blade.php'))) {
            $this->replaceInFile("{{ url('/home') }}", "{{ url(config('filament.path')) }}", resource_path('views/welcome.blade.php'));
            $this->replaceInFile('Home', "{{ucfirst(config('filament.path'))}}", resource_path('views/welcome.blade.php'));
        }

        // Fortify Provider...
        $this->installServiceProviderAfter('RouteServiceProvider', 'FortifyServiceProvider');

        // Configure Session...
        $this->configureSession();

        // Configure API...
        if ($this->option('api')) {
            $this->replaceInFile('// Features::api(),', 'Features::api(),', config_path('filament-companies.php'));
        }

        // Configure Email Verification...
        if ($this->option('verification')) {
            $this->replaceInFile('// Features::emailVerification(),', 'Features::emailVerification(),', config_path('fortify.php'));
        }

        // Install Stack...
        if ($this->argument('stack') === 'filament') {
            $this->installFilamentStack();
        }

        // Tests...
        $stubs = $this->getTestStubsPath();

        if ($this->option('pest')) {
            $this->removeComposerDevPackages(['nunomaduro/collision', 'phpunit/phpunit']);

            if (! $this->requireComposerDevPackages(['nunomaduro/collision:^6.4', 'pestphp/pest:^1.22', 'pestphp/pest-plugin-laravel:^1.2'])) {
                return 1;
            }

            copy($stubs.'/Pest.php', base_path('tests/Pest.php'));
            copy($stubs.'/ExampleTest.php', base_path('tests/Feature/ExampleTest.php'));
            copy($stubs.'/ExampleUnitTest.php', base_path('tests/Unit/ExampleTest.php'));
        }

        copy($stubs.'/AuthenticationTest.php', base_path('tests/Feature/AuthenticationTest.php'));
        copy($stubs.'/EmailVerificationTest.php', base_path('tests/Feature/EmailVerificationTest.php'));
        copy($stubs.'/PasswordConfirmationTest.php', base_path('tests/Feature/PasswordConfirmationTest.php'));
        copy($stubs.'/PasswordResetTest.php', base_path('tests/Feature/PasswordResetTest.php'));
        copy($stubs.'/RegistrationTest.php', base_path('tests/Feature/RegistrationTest.php'));

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

        // Update Configuration...
        $this->replaceInFile('filament', 'filament', config_path('filament-companies.php'));
        // $this->replaceInFile("'guard' => 'web'", "'guard' => 'sanctum'", config_path('auth.php'));

        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Fortify'));
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/FilamentCompanies'));
        (new Filesystem)->ensureDirectoryExists(resource_path('markdown'));

        (new Filesystem)->deleteDirectory(resource_path('sass'));

        // Terms Of Service / Privacy Policy...
        copy(__DIR__.'/../../stubs/resources/markdown/terms.md', resource_path('markdown/terms.md'));
        copy(__DIR__.'/../../stubs/resources/markdown/policy.md', resource_path('markdown/policy.md'));

        // Service Providers...
        $this->installServiceProviderAfter('FortifyServiceProvider', 'FilamentCompaniesServiceProvider');

        // Factories...
        copy(__DIR__.'/../../database/factories/UserFactory.php', base_path('database/factories/UserFactory.php'));

        // Actions...
        copy(__DIR__.'/../../stubs/app/Actions/Fortify/CreateNewUser.php', app_path('Actions/Fortify/CreateNewUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/Fortify/UpdateUserPassword.php', app_path('Actions/Fortify/UpdateUserPassword.php'));
        copy(__DIR__.'/../../stubs/app/Actions/Fortify/UpdateUserProfileInformation.php', app_path('Actions/Fortify/UpdateUserProfileInformation.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/DeleteUser.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));

        // Routes...
        $this->replaceInFile('auth:api', 'auth:sanctum', base_path('routes/api.php'));

        if (! Str::contains(file_get_contents(base_path('routes/web.php')), "'/admin'")) {
            (new Filesystem)->append(base_path('routes/web.php'), $this->livewireRouteDefinition());
        }

        // Tests...
        $stubs = $this->getTestStubsPath();

        copy($stubs.'/filament/BrowserSessionsTest.php', base_path('tests/Feature/BrowserSessionsTest.php'));
        copy($stubs.'/filament/DeleteAccountTest.php', base_path('tests/Feature/DeleteAccountTest.php'));
        copy($stubs.'/filament/ProfileInformationTest.php', base_path('tests/Feature/ProfileInformationTest.php'));
        copy($stubs.'/filament/TwoFactorAuthenticationSettingsTest.php', base_path('tests/Feature/TwoFactorAuthenticationSettingsTest.php'));
        copy($stubs.'/filament/UpdatePasswordTest.php', base_path('tests/Feature/UpdatePasswordTest.php'));

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
        // Tests...
        $stubs = $this->getTestStubsPath();

        copy($stubs.'/filament/CreateCompanyTest.php', base_path('tests/Feature/CreateCompanyTest.php'));
        copy($stubs.'/filament/DeleteCompanyTest.php', base_path('tests/Feature/DeleteCompanyTest.php'));
        copy($stubs.'/filament/InviteCompanyEmployeeTest.php', base_path('tests/Feature/InviteCompanyEmployeeTest.php'));
        copy($stubs.'/filament/LeaveCompanyTest.php', base_path('tests/Feature/LeaveCompanyTest.php'));
        copy($stubs.'/filament/RemoveCompanyEmployeeTest.php', base_path('tests/Feature/RemoveCompanyEmployeeTest.php'));
        copy($stubs.'/filament/UpdateCompanyEmployeeRoleTest.php', base_path('tests/Feature/UpdateCompanyEmployeeRoleTest.php'));
        copy($stubs.'/filament/UpdateCompanyNameTest.php', base_path('tests/Feature/UpdateCompanyNameTest.php'));

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
     * Get the route definition(s) that should be installed for Filament.
     */
    protected function livewireRouteDefinition(): string
    {
        return <<<'EOF'

Route::middleware([
    'auth:sanctum',
    config('filament-companies.auth_session'),
    'verified'
])->group(function () {

});

EOF;
    }

    /**
     * Ensure the installed user model is ready for company usage.
     */
    protected function ensureApplicationIsCompanyCompatible(): void
    {
        // Publish FilamentCompanies Company Migrations...
        $this->callSilent('vendor:publish', ['--tag' => 'filament-companies-company-migrations', '--force' => true]);

        // Publish Filament Configuration File...
        $this->callSilent('vendor:publish', ['--tag' => 'filament-config', '--force' => true]);

        // Configuration...
        $this->replaceInFile('use Filament\Http\Middleware\Authenticate', 'use App\Http\Middleware\Authenticate', config_path('filament.php'));
        $this->replaceInFile('use Illuminate\Session\Middleware\AuthenticateSession', 'use Wallo\FilamentCompanies\Http\Middleware\AuthenticateSession', config_path('filament.php'));
        $this->replaceInFile('\Filament\Http\Livewire\Auth\Login::class', 'null', config_path('filament.php'));
        $this->replaceInFile('RouteServiceProvider::HOME', "config('filament.path')", config_path('fortify.php'));
        $this->replaceInFile("'middleware' => ['web'],", "'middleware' => config('filament.middleware.base'),", config_path('fortify.php'));

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

        // Fortify Actions...
        copy(__DIR__.'/../../stubs/app/Actions/Fortify/CreateNewUser.php', app_path('Actions/Fortify/CreateNewUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/Fortify/UpdateUserPassword.php', app_path('Actions/Fortify/UpdateUserPassword.php'));

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

        // Configuration...
        $this->replaceInFile('// Features::socialite([\'rememberSession\' => true, \'providerAvatars\' => true])', 'Features::socialite([\'rememberSession\' => true, \'providerAvatars\' => true])', config_path('filament-companies.php'));
        $this->replaceInFile('// Providers::github(),', 'Providers::github(),', config_path('filament-companies.php'));

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
     * Returns the path to the correct test stubs.
     */
    protected function getTestStubsPath(): string
    {
        return $this->option('pest')
            ? __DIR__.'/../../stubs/pest-tests'
            : __DIR__.'/../../stubs/tests';
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
