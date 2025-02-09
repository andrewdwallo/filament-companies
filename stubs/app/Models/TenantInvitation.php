<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wallo\FilamentTenants\FilamentTenants;

class TenantInvitation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'role',
    ];

    /**
     * Get the tenant that the invitation belongs to.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(FilamentTenants::tenantModel());
    }
}
