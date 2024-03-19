<?php

namespace Wallo\FilamentCompanies\Mail;

use App\Models\CompanyInvitation as CompanyInvitationModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Wallo\FilamentCompanies\FilamentCompanies;

class CompanyInvitation extends Mailable
{
    use Queueable;
    use SerializesModels;

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
        $acceptUrl = FilamentCompanies::generateAcceptInvitationUrl($this->invitation);

        return $this->markdown('filament-companies::mail.company-invitation', compact('acceptUrl'))
            ->subject(__('Company Invitation'));
    }
}
