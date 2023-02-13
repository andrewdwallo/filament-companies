<x-filament::page>

    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm::class)
        </div>

            <x-filament-companies::section-border />
    @endif

    @if (!is_null($user->password) && Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
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

    @if (!is_null($user->password) && Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\TwoFactorAuthenticationForm::class)
        </div>

            <x-filament-companies::section-border />
    @endif

    @if (Wallo\FilamentCompanies\Socialite::show())
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm::class)
        </div>

            <x-filament-companies::section-border />
    @endif

    @if (!is_null($user->password))
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm::class)
        </div>

            <x-filament-companies::section-border />
    @endif

    @if (!is_null($user->password) && Wallo\FilamentCompanies\FilamentCompanies::hasAccountDeletionFeatures())
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm::class)
        </div>
    @endif
</x-filament::page>
