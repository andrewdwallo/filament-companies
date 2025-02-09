<?php

namespace Wallo\FilamentTenants\Mail;

use App\Models\TenantInvitation as TenantInvitationModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Wallo\FilamentTenants\FilamentTenants;

class TenantInvitation extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The tenant invitation instance.
     */
    public TenantInvitationModel $invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TenantInvitationModel $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        $acceptUrl = FilamentTenants::generateAcceptInvitationUrl($this->invitation);

        return $this->markdown('filament-tenants::mail.tenant-invitation', compact('acceptUrl'))
            ->subject(__('Tenant Invitation'));
    }
}
