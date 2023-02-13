<?php

namespace Wallo\FilamentCompanies\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use App\Models\CompanyInvitation as CompanyInvitationModel;

class CompanyInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The company invitation instance.
     *
     * @var CompanyInvitationModel
     */
    public CompanyInvitationModel $invitation;

    /**
     * Create a new message instance.
     *
     * @param CompanyInvitationModel $invitation
     * @return void
     */
    public function __construct(CompanyInvitationModel $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('filament-companies::mail.company-invitation', ['acceptUrl' => URL::signedRoute('company-invitations.accept', [
            'invitation' => $this->invitation,
        ])])->subject(__('Company Invitation'));
    }
}
