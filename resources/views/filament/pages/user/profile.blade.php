<x-filament::page>

    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm::class)
        </div>

        <x-filament-companies::section-border />
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()) && ! is_null($user->password))
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm::class)
        </div>

        <x-filament-companies::section-border />
    @else
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\SetPasswordForm::class)
        </div>

        <x-filament-companies::section-border />
    @endif

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication() && ! is_null($user->password))
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\TwoFactorAuthenticationForm::class)
        </div>

        <x-filament-companies::section-border />
    @endif

    @if (Wallo\FilamentCompanies\Socialite::show())
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm::class)
        </div>
    @endif

    @if ( ! is_null($user->password))
        <x-filament-companies::section-border />

        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm::class)
        </div>
    @endif

    @if (Wallo\FilamentCompanies\FilamentCompanies::hasAccountDeletionFeatures() && is_null($user->password))
        <x-filament-companies::section-border />

        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm::class)
        </div>
    @endif
</x-filament::page>
