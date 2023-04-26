<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Livewire\Redirector;
use Wallo\FilamentCompanies\Contracts\AddsCompanyEmployees;
use Wallo\FilamentCompanies\FilamentCompanies;

class CompanyInvitationController extends Controller
{
    /**
     * Accept a company invitation.
     */
    public function accept(Request $request, int $invitationId): Redirector|RedirectResponse|null
    {
        $model = FilamentCompanies::companyInvitationModel();

        $invitation = $model::whereKey($invitationId)->firstOrFail();

        app(AddsCompanyEmployees::class)->add(
            $invitation->company->owner,
            $invitation->company,
            $invitation->email,
            $invitation->role
        );

        $invitation->delete();

        return redirect(config('fortify.home'))->banner(
            __('filament-companies::default.banner.company_invitation_accepted', ['company' => $invitation->company->name]),
        );
    }

    /**
     * Cancel the given company invitation.
     *
     * @throws AuthorizationException
     */
    public function destroy(Request $request, int $invitationId): Redirector|RedirectResponse
    {
        $model = FilamentCompanies::companyInvitationModel();

        $invitation = $model::whereKey($invitationId)->firstOrFail();

        if (! Gate::forUser($request->user())->check('removeCompanyEmployee', $invitation->company)) {
            throw new AuthorizationException;
        }

        $invitation->delete();

        return back(303);
    }
}
