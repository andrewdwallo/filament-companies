<x-filament-panels::page>
    @if (Wallo\FilamentCompanies\Features::canUpdateProfileInformation())
        @livewire(Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm::class)
        <x-filament-companies::section-border />
    @endif

    @if ($user->password !== null && Wallo\FilamentCompanies\Features::canUpdatePasswords())
        @livewire(Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm::class)
        <x-filament-companies::section-border />
    @elseif ($user->password === null)
        @livewire(Wallo\FilamentCompanies\Http\Livewire\SetPasswordForm::class)
        <x-filament-companies::section-border />
    @endif

    @if (Wallo\FilamentCompanies\Socialite::hasSocialiteFeatures())
        @livewire(Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm::class)
        <x-filament-companies::section-border />
    @endif

    @if ($user->password !== null)
        @livewire(Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm::class)
    @endif

    @if ($user->password !== null && Wallo\FilamentCompanies\Features::hasAccountDeletionFeatures())
        <x-filament-companies::section-border />
        @livewire(Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm::class)
    @endif
</x-filament-panels::page>
