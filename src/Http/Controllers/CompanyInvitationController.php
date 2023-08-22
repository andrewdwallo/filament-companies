<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\Features\SupportRedirects\Redirector;
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
        $user = FilamentCompanies::userModel()::where('email', $invitation->email)->first();

        app(AddsCompanyEmployees::class)->add(
            $invitation->company->owner,
            $invitation->company,
            $invitation->email,
            $invitation->role
        );

        $invitation->delete();

        $title = __('filament-companies::default.banner.company_invitation_accepted', ['company' => $invitation->company->name]);
        $notification = Notification::make()->title(Str::inlineMarkdown($title))->success()->persistent()->send();

        if ($user) {
            Filament::auth()->login($user);
            return redirect(url(filament()->getHomeUrl()))->with('notification.success.company_invitation_accepted', $notification);
        }

        return redirect(url(filament()->getLoginUrl()));
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
