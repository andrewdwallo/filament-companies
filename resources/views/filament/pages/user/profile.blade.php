<x-filament::page>

    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm::class)
        </div>

        <x-filament-companies::section-border />
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm::class)
        </div>

        <x-filament-companies::section-border />
    @endif

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\TwoFactorAuthenticationForm::class)
        </div>

        <x-filament-companies::section-border />
    @endif

    <div class="mt-10 sm:mt-0">
        @livewire(\Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm::class)
    </div>

    @if (Wallo\FilamentCompanies\FilamentCompanies::hasAccountDeletionFeatures())
        <x-filament-companies::section-border />

        <div class="mt-10 sm:mt-0">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm::class)
        </div>
    @endif
</x-filament::page>
