<?php

namespace Wallo\FilamentTenants\Http\Controllers;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\Features\SupportRedirects\Redirector;
use Wallo\FilamentTenants\Contracts\AddsTenantEmployees;
use Wallo\FilamentTenants\FilamentTenants;

class TenantInvitationController extends Controller
{
    /**
     * Accept a tenant invitation.
     */
    public function accept(Request $request, int|string $invitationId): Redirector | RedirectResponse | null
    {
        $model = FilamentTenants::tenantInvitationModel();

        $invitation = $model::whereKey($invitationId)->firstOrFail();
        $user = FilamentTenants::userModel()::where('email', $invitation->email)->first();

        app(AddsTenantEmployees::class)->add(
            $invitation->tenant->owner,
            $invitation->tenant,
            $invitation->email,
            $invitation->role
        );

        $invitation->delete();

        $title = __('filament-tenants::default.banner.tenant_invitation_accepted', ['tenant' => $invitation->tenant->name]);
        $notification = Notification::make()->title(Str::inlineMarkdown($title))->success()->persistent()->send();

        if ($user) {
            Filament::auth()->login($user);

            return redirect(url(filament()->getHomeUrl()))->with('notification.success.tenant_invitation_accepted', $notification);
        }

        return redirect(url(filament()->getLoginUrl()));
    }

    /**
     * Cancel the given tenant invitation.
     *
     * @throws AuthorizationException
     */
    public function destroy(Request $request, int $invitationId): Redirector | RedirectResponse
    {
        $model = FilamentTenants::tenantInvitationModel();

        $invitation = $model::whereKey($invitationId)->firstOrFail();

        if (! Gate::forUser($request->user())->check('removeTenantEmployee', $invitation->tenant)) {
            throw new AuthorizationException;
        }

        $invitation->delete();

        return back(303);
    }
}
