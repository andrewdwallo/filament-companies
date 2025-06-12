<?php

namespace Wallo\FilamentCompanies\Http\Responses\Auth;

use Filament\Auth\Http\Responses\RegistrationResponse;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesRegistrationResponse extends RegistrationResponse
{
    public function toResponse($request): RedirectResponse | Redirector
    {
        $user = Filament::auth()->user();

        if (
            FilamentCompanies::autoAcceptsInvitations() &&
            method_exists($user, 'hasAnyCompanies') &&
            ! $user->hasAnyCompanies() &&
            ($invitation = FilamentCompanies::companyInvitationModel()::where('email', $user->email)->first())
        ) {
            return redirect(FilamentCompanies::generateAcceptInvitationUrl($invitation));
        }

        return parent::toResponse($request);
    }
}
