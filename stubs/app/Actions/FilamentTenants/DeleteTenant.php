<?php

namespace App\Actions\FilamentTenants;

use App\Models\Tenant;
use Wallo\FilamentTenants\Contracts\DeletesTenants;

class DeleteTenant implements DeletesTenants
{
    /**
     * Delete the given tenant.
     */
    public function delete(Tenant $tenant): void
    {
        $tenant->purge();
    }
}
