<?php

namespace App\Models;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Wallo\FilamentTenants\Tenant as FilamentTenantsTenant;
use Wallo\FilamentTenants\Events\TenantCreated;
use Wallo\FilamentTenants\Events\TenantDeleted;
use Wallo\FilamentTenants\Events\TenantUpdated;

class Tenant extends FilamentTenantsTenant implements HasAvatar
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'personal_tenant',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TenantCreated::class,
        'updated' => TenantUpdated::class,
        'deleted' => TenantDeleted::class,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'personal_tenant' => 'boolean',
        ];
    }

    public function getFilamentAvatarUrl(): string
    {
        return $this->owner->profile_photo_url;
    }
}
