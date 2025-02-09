<?php

namespace Wallo\FilamentTenants\Listeners;

use Filament\Events\TenantSet;
use Wallo\FilamentTenants\FilamentTenants;
use Wallo\FilamentTenants\HasTenants;

class SwitchCurrentTenant
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

        /** @var HasTenants $user */
        $user = $event->getUser();

        if (FilamentTenants::switchesCurrentTenant() === false || ! in_array(HasTenants::class, class_uses_recursive($user), true)) {
            return;
        }

        if (! $user->switchTenant($tenant) && ($fallbackTenant = $user->primaryTenant())) {
            $user->switchTenant($fallbackTenant);
        }
    }
}
