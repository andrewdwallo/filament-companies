<?php

namespace Wallo\FilamentCompanies\Mail;

use App\Models\CompanyInvitation as CompanyInvitationModel;
use Exception;
use Filament\Facades\Filament;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Wallo\FilamentCompanies\Features;

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
        foreach (Filament::getPanels() as $panel) {
            $panelId = $panel->getId();

            $routeName = 'filament.' . $panelId . '.' . $panelId . '-invitations.accept';

            return $this->markdown('filament-companies::mail.company-invitation', ['acceptUrl' => URL::signedRoute($routeName, [
                'invitation' => $this->invitation,
                'tenant' => Filament::getTenant(),
            ])])->subject(__('Company Invitation'));
        }

        return $this->markdown('filament-companies::mail.company-invitation', ['acceptUrl' => URL::signedRoute('filament.company.company-invitations.accept', [
            'invitation' => $this->invitation,
            'tenant' => Filament::getTenant(),
        ])])->subject(__('Company Invitation'));
    }
}
