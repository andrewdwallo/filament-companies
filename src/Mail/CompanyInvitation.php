<?php

namespace Wallo\FilamentCompanies\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Wallo\FilamentCompanies\CompanyInvitation as CompanyInvitationModel;

class CompanyInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The company invitation instance.
     *
     * @var \Wallo\FilamentCompanies\CompanyInvitation
     */
    public $invitation;

    /**
     * Create a new message instance.
     *
     * @param  \Wallo\FilamentCompanies\CompanyInvitation  $invitation
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
    public function build()
    {
        return $this->markdown('filamentcompanies::mail.company-invitation', ['acceptUrl' => URL::signedRoute('company-invitations.accept', [
            'invitation' => $this->invitation,
        ])])->subject(__('Company Invitation'));
    }
}
