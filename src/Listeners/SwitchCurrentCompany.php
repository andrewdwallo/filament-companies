<?php

namespace Wallo\FilamentCompanies\Listeners;

use Filament\Events\TenantSet;
use Wallo\FilamentCompanies\Features;
use Wallo\FilamentCompanies\HasCompanies;

class SwitchCurrentCompany
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TenantSet $event): void
    {
        $tenant = $event->getTenant();
        $user = $event->getUser();

        if (Features::switchesCurrentCompany() === false || ! in_array(HasCompanies::class, class_uses_recursive($user), true)) {
            return;
        }

        if (! $user->isCurrentCompany($tenant)) {
            $user->switchCompany($tenant);
        }
    }
}
