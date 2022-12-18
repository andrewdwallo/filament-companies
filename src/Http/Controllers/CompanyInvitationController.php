<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\Contracts\AddsCompanyEmployees;
use Wallo\FilamentCompanies\CompanyInvitation;

class CompanyInvitationController extends Controller
{
    /**
     * Accept a company invitation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Wallo\FilamentCompanies\CompanyInvitation  $invitation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(Request $request, CompanyInvitation $invitation)
    {
        app(AddsCompanyEmployees::class)->add(
            $invitation->company->owner,
            $invitation->company,
            $invitation->email,
            $invitation->role
        );

        $invitation->delete();

        return redirect(config('fortify.home'))->banner(
            __('Great! You have accepted the invitation to join the :company company.', ['company' => $invitation->company->name]),
        );
    }

    /**
     * Cancel the given company invitation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Wallo\FilamentCompanies\CompanyInvitation  $invitation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, CompanyInvitation $invitation)
    {
        if (! Gate::forUser($request->user())->check('removeCompanyEmployee', $invitation->company)) {
            throw new AuthorizationException;
        }

        $invitation->delete();

        return back(303);
    }
}
