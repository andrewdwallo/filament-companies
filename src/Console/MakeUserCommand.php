<?php

namespace Wallo\FilamentCompanies\Console;

use App\Actions\Fortify\CreateNewUser;
use Filament\Support\Commands\Concerns\CanValidateInput;
use Illuminate\Console\Command;
use Laravel\Fortify\Rules\Password;
use Wallo\FilamentCompanies\FilamentCompanies;

class MakeUserCommand extends Command
{
    use CanValidateInput;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Filament Companies user';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filament-companies-user
                            {--name= : The name of the user}
                            {--email= : The valid and unique email of the user}
                            {--password= : The password of the user (min. 8 characters)}';

    /**
     * The options for the console command.
     */
    protected array $options;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->validateInput(fn () => $this->options['name'] ?? $this->ask('Name'), 'name', ['required', 'string', 'max:255'], fn () => $this->options['name'] = null);
        $email = $this->validateInput(fn () => $this->options['email'] ?? $this->ask('Email address'), 'email', ['required', 'string', 'email', 'max:255', 'unique:' . $this->getUserModel()], fn () => $this->options['email'] = null);
        $password = $this->validateInput(fn () => $this->options['password'] ?? $this->secret('Password'), 'password', ['required', 'string', (new Password)->length(8)], fn () => $this->options['password'] = null);

        $createNewUser = new CreateNewUser();

        $user = $createNewUser->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'terms' => FilamentCompanies::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $this->sendSuccessMessage($user);

        return static::SUCCESS;
    }

    /**
     * Send the success message.
     */
    protected function sendSuccessMessage($user): void
    {
        $loginUrl = route('login');
        $this->info('Success! ' . ($user->name ?? $user->email ?? 'You') . " may now log in at {$loginUrl}.");

        if ($this->confirm('Would you like to show some love by starring the repo?', true) && $this->getUserModel()::count() === 1) {
            if (PHP_OS_FAMILY === 'Darwin') {
                exec('open https://github.com/andrewdwallo/filament-companies');
            }
            if (PHP_OS_FAMILY === 'Linux') {
                exec('xdg-open https://github.com/andrewdwallo/filament-companies');
            }
            if (PHP_OS_FAMILY === 'Windows') {
                exec('start https://github.com/andrewdwallo/filament-companies');
            }

            $this->line('Thank you!');
        }
    }

    /**
     * Get the user model.
     */
    protected function getUserModel(): string
    {
        return config('auth.providers.users.model');
    }
}
