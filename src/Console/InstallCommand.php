<?php

namespace Wallo\FilamentCompanies\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
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
     *
     * @return int|null
     */
    public function handle()
    {
        if (! in_array($this->argument('stack'), ['filament'])) {
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
            $this->replaceInFile('/home', config('filament.path'), resource_path('views/welcome.blade.php'));
            $this->replaceInFile('Home', "{{ucfirst(trans(config('filament.path')))}}", resource_path('views/welcome.blade.php'));
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
            $this->requireComposerDevPackages('pestphp/pest:^1.16', 'pestphp/pest-plugin-laravel:^1.1');

            copy($stubs.'/Pest.php', base_path('tests/Pest.php'));
            copy($stubs.'/ExampleTest.php', base_path('tests/Feature/ExampleTest.php'));
            copy($stubs.'/ExampleUnitTest.php', base_path('tests/Unit/ExampleTest.php'));
        }

        copy($stubs.'/AuthenticationTest.php', base_path('tests/Feature/AuthenticationTest.php'));
        copy($stubs.'/EmailVerificationTest.php', base_path('tests/Feature/EmailVerificationTest.php'));
        copy($stubs.'/PasswordConfirmationTest.php', base_path('tests/Feature/PasswordConfirmationTest.php'));
        copy($stubs.'/PasswordResetTest.php', base_path('tests/Feature/PasswordResetTest.php'));
        copy($stubs.'/RegistrationTest.php', base_path('tests/Feature/RegistrationTest.php'));
    }

    /**
     * Configure the session driver for Company.
     *
     * @return void
     */
    protected function configureSession()
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
     * Install the Livewire stack into the application.
     *
     * @return void
     */
    protected function installFilamentStack()
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

        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return [
                '@tailwindcss/forms' => '^0.5.2',
                '@tailwindcss/typography' => '^0.5.0',
                'alpinejs' => '^3.0.6',
                '@alpinejs/focus' => '^3.10.5',
                'autoprefixer' => '^10.4.7',
                'postcss' => '^8.4.14',
                'tailwindcss' => '^3.1.0',
                '@awcodes/alpine-floating-ui' => '^3.4.0',
            ] + $packages;
        });

        // Tailwind Configuration...
        copy(__DIR__.'/../../stubs/filament/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__.'/../../stubs/filament/postcss.config.js', base_path('postcss.config.js'));
        copy(__DIR__.'/../../stubs/filament/vite.config.js', base_path('vite.config.js'));

        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/Fortify'));
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/FilamentCompanies'));
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->ensureDirectoryExists(resource_path('css'));
        (new Filesystem)->ensureDirectoryExists(resource_path('markdown'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/api'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/auth'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/profile'));

        (new Filesystem)->deleteDirectory(resource_path('sass'));

        // Terms Of Service / Privacy Policy...
        copy(__DIR__.'/../../stubs/resources/markdown/terms.md', resource_path('markdown/terms.md'));
        copy(__DIR__.'/../../stubs/resources/markdown/policy.md', resource_path('markdown/policy.md'));

        // Service Providers...
        copy(__DIR__.'/../../stubs/app/Providers/FilamentCompaniesServiceProvider.php', app_path('Providers/FilamentCompaniesServiceProvider.php'));
        $this->installServiceProviderAfter('FortifyServiceProvider', 'FilamentCompaniesServiceProvider');

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/User.php', app_path('Models/User.php'));

        // Factories...
        copy(__DIR__.'/../../database/factories/UserFactory.php', base_path('database/factories/UserFactory.php'));

        // Actions...
        copy(__DIR__.'/../../stubs/app/Actions/Fortify/CreateNewUser.php', app_path('Actions/Fortify/CreateNewUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/Fortify/UpdateUserProfileInformation.php', app_path('Actions/Fortify/UpdateUserProfileInformation.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/DeleteUser.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));

        // View Components...
        copy(__DIR__.'/../../stubs/filament/app/View/Components/AppLayout.php', app_path('View/Components/AppLayout.php'));
        copy(__DIR__.'/../../stubs/filament/app/View/Components/GuestLayout.php', app_path('View/Components/GuestLayout.php'));

        // Layouts...
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/filament/resources/views/layouts', resource_path('views/layouts'));

        // Single Blade Views...
        copy(__DIR__.'/../../stubs/filament/resources/views/navigation-menu.blade.php', resource_path('views/navigation-menu.blade.php'));
        copy(__DIR__.'/../../stubs/filament/resources/views/terms.blade.php', resource_path('views/terms.blade.php'));
        copy(__DIR__.'/../../stubs/filament/resources/views/policy.blade.php', resource_path('views/policy.blade.php'));

        // Other Views...
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/filament/resources/views/api', resource_path('views/api'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/filament/resources/views/profile', resource_path('views/profile'));
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/filament/resources/views/auth', resource_path('views/auth'));

        // Routes...
        $this->replaceInFile('auth:api', 'auth:sanctum', base_path('routes/api.php'));

        if (! Str::contains(file_get_contents(base_path('routes/web.php')), "'/admin'")) {
            (new Filesystem)->append(base_path('routes/web.php'), $this->livewireRouteDefinition());
        }

        // Assets...
        copy(__DIR__.'/../../stubs/resources/css/app.css', resource_path('css/app.css'));
        copy(__DIR__.'/../../stubs/filament/resources/js/app.js', resource_path('js/app.js'));

        // Tests...
        $stubs = $this->getTestStubsPath();

        copy($stubs.'/filament/ApiTokenPermissionsTest.php', base_path('tests/Feature/ApiTokenPermissionsTest.php'));
        copy($stubs.'/filament/BrowserSessionsTest.php', base_path('tests/Feature/BrowserSessionsTest.php'));
        copy($stubs.'/filament/CreateApiTokenTest.php', base_path('tests/Feature/CreateApiTokenTest.php'));
        copy($stubs.'/filament/DeleteAccountTest.php', base_path('tests/Feature/DeleteAccountTest.php'));
        copy($stubs.'/filament/DeleteApiTokenTest.php', base_path('tests/Feature/DeleteApiTokenTest.php'));
        copy($stubs.'/filament/ProfileInformationTest.php', base_path('tests/Feature/ProfileInformationTest.php'));
        copy($stubs.'/filament/TwoFactorAuthenticationSettingsTest.php', base_path('tests/Feature/TwoFactorAuthenticationSettingsTest.php'));
        copy($stubs.'/filament/UpdatePasswordTest.php', base_path('tests/Feature/UpdatePasswordTest.php'));

        // Companies...
        if ($this->option('companies')) {
            $this->installFilamentCompanyStack();
        }

        if (file_exists(base_path('pnpm-lock.yaml'))) {
            $this->runCommands(['pnpm install', 'pnpm run build']);
        } elseif (file_exists(base_path('yarn.lock'))) {
            $this->runCommands(['yarn install', 'yarn run build']);
        } else {
            $this->runCommands(['npm install', 'npm run build']);
        }

        $this->line('');
        $this->components->info('Filament scaffolding installed successfully.');
    }

    /**
     * Install the Livewire company stack into the application.
     *
     * @return void
     */
    protected function installFilamentCompanyStack()
    {
        // Directories...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/companies'));

        (new Filesystem)->ensureDirectoryExists(resource_path('views/filament'));

        // Other Views...
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/filament/resources/views/companies', resource_path('views/companies'));

        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/filament/resources/views/filament', resource_path('views/filament'));

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
    }

    /**
     * Get the route definition(s) that should be installed for Livewire.
     *
     * @return string
     */
    protected function livewireRouteDefinition()
    {
        return <<<'EOF'

Route::middleware([
    'auth:sanctum',
    config('filament-companies.auth_session'),
    'verified'
]);

EOF;
    }

    /**
     * Ensure the installed user model is ready for company usage.
     *
     * @return void
     */
    protected function ensureApplicationIsCompanyCompatible()
    {
        // Publish Company Migrations...
        $this->callSilent('vendor:publish', ['--tag' => 'filament-companies-company-migrations', '--force' => true]);

        $this->callSilent('vendor:publish', ['--tag' => 'filament-config', '--force' => true]);

        // Configuration...
        $this->replaceInFile('// Features::companies([\'invitations\' => true])', 'Features::companies([\'invitations\' => true])', config_path('filament-companies.php'));

        $this->replaceInFile('// Features::api(),', 'Features::api(),', config_path('filament-companies.php'));


        $this->replaceInFile('use Filament\Http\Middleware\Authenticate', 'use App\Http\Middleware\Authenticate', config_path('filament.php'));

        $this->replaceInFile('use Illuminate\Session\Middleware\AuthenticateSession', 'use Wallo\FilamentCompanies\Http\Middleware\AuthenticateSession', config_path('filament.php'));

        $this->replaceInFile('\Filament\Http\Livewire\Auth\Login::class', 'null', config_path('filament.php'));

        $this->replaceInFile("RouteServiceProvider::HOME", "config('filament.path')", config_path('fortify.php'));


        // Directories...
        (new Filesystem)->ensureDirectoryExists(app_path('Actions/FilamentCompanies'));
        (new Filesystem)->ensureDirectoryExists(app_path('Events'));
        (new Filesystem)->ensureDirectoryExists(app_path('Filament/Pages/User'));
        (new Filesystem)->ensureDirectoryExists(app_path('Filament/Pages/Companies'));
        (new Filesystem)->ensureDirectoryExists(app_path('Policies'));


        // Service Providers...
        copy(__DIR__.'/../../stubs/app/Providers/AuthServiceProvider.php', app_path('Providers/AuthServiceProvider.php'));
        copy(__DIR__.'/../../stubs/app/Providers/FilamentCompaniesWithCompaniesServiceProvider.php', app_path('Providers/FilamentCompaniesServiceProvider.php'));

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/Employeeship.php', app_path('Models/Employeeship.php'));
        copy(__DIR__.'/../../stubs/app/Models/Company.php', app_path('Models/Company.php'));
        copy(__DIR__.'/../../stubs/app/Models/CompanyInvitation.php', app_path('Models/CompanyInvitation.php'));
        copy(__DIR__.'/../../stubs/app/Models/UserWithCompanies.php', app_path('Models/User.php'));

        // Actions...
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/AddCompanyEmployee.php', app_path('Actions/FilamentCompanies/AddCompanyEmployee.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/CreateCompany.php', app_path('Actions/FilamentCompanies/CreateCompany.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/DeleteCompany.php', app_path('Actions/FilamentCompanies/DeleteCompany.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/DeleteUserWithCompanies.php', app_path('Actions/FilamentCompanies/DeleteUser.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/InviteCompanyEmployee.php', app_path('Actions/FilamentCompanies/InviteCompanyEmployee.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/RemoveCompanyEmployee.php', app_path('Actions/FilamentCompanies/RemoveCompanyEmployee.php'));
        copy(__DIR__.'/../../stubs/app/Actions/FilamentCompanies/UpdateCompanyName.php', app_path('Actions/FilamentCompanies/UpdateCompanyName.php'));

        copy(__DIR__.'/../../stubs/app/Actions/Fortify/CreateNewUserWithCompanies.php', app_path('Actions/Fortify/CreateNewUser.php'));

        copy(__DIR__.'/../../stubs/app/Filament/Pages/User/Profile.php', app_path('Filament/Pages/User/Profile.php'));
        copy(__DIR__.'/../../stubs/app/Filament/Pages/User/ApiTokens.php', app_path('Filament/Pages/User/ApiTokens.php'));

        copy(__DIR__.'/../../stubs/app/Filament/Pages/Companies/Create.php', app_path('Filament/Pages/Companies/Create.php'));
        copy(__DIR__.'/../../stubs/app/Filament/Pages/Companies/Show.php', app_path('Filament/Pages/Companies/Show.php'));

        // Policies...
        (new Filesystem)->copyDirectory(__DIR__.'/../../stubs/app/Policies', app_path('Policies'));

        // Factories...
        copy(__DIR__.'/../../database/factories/UserFactory.php', base_path('database/factories/UserFactory.php'));
        copy(__DIR__.'/../../database/factories/CompanyFactory.php', base_path('database/factories/CompanyFactory.php'));
    }

    /**
     * Install the service provider in the application configuration file.
     *
     * @param  string  $after
     * @param  string  $name
     * @return void
     */
    protected function installServiceProviderAfter($after, $name)
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
     * Install the middleware to a group in the application Http Kernel.
     *
     * @param  string  $after
     * @param  string  $name
     * @param  string  $group
     * @return void
     */
    protected function installMiddlewareAfter($after, $name, $group = 'web')
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $middlewareGroups = Str::before(Str::after($httpKernel, '$middlewareGroups = ['), '];');
        $middlewareGroup = Str::before(Str::after($middlewareGroups, "'$group' => ["), '],');

        if (! Str::contains($middlewareGroup, $name)) {
            $modifiedMiddlewareGroup = str_replace(
                $after.',',
                $after.','.PHP_EOL.'            '.$name.',',
                $middlewareGroup,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $middlewareGroups,
                str_replace($middlewareGroup, $modifiedMiddlewareGroup, $middlewareGroups),
                $httpKernel
            ));
        }
    }

    /**
     * Returns the path to the correct test stubs.
     *
     * @return string
     */
    protected function getTestStubsPath()
    {
        return $this->option('pest')
            ? __DIR__.'/../../stubs/pest-tests'
            : __DIR__.'/../../stubs/tests';
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = [$this->phpBinary(), $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Install the given Composer Packages as "dev" dependencies.
     *
     * @param  mixed  $packages
     * @return void
     */
    protected function requireComposerDevPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = [$this->phpBinary(), $composer, 'require', '--dev'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require', '--dev'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('pnpm-lock.yaml'));
            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    /**
     * Get the path to the appropriate PHP binary.
     *
     * @return string
     */
    protected function phpBinary()
    {
        return (new PhpExecutableFinder())->find(false) ?: 'php';
    }

    /**
     * Run the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }
}
