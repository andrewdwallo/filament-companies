<?php

namespace Wallo\FilamentCompanies\Mail;

use App\Models\CompanyInvitation as CompanyInvitationModel;
use Filament\Facades\Filament;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class CompanyInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The company invitation instance.
     */
    public CompanyInvitationModel $invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CompanyInvitationModel $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        $panelId = \Wallo\FilamentCompanies\Socialite::getPanelId();

        $routeName = 'filament.' . $panelId . '.' . $panelId . '-invitations.accept';

        return $this->markdown('filament-companies::mail.company-invitation', ['acceptUrl' => URL::signedRoute($routeName, [
            'invitation' => $this->invitation,
        ])])->subject(__('Company Invitation'));
    }
}
