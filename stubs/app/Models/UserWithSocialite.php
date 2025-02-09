<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Wallo\FilamentTenants\HasTenants;
use Wallo\FilamentTenants\HasConnectedAccounts;
use Wallo\FilamentTenants\HasProfilePhoto;
use Wallo\FilamentTenants\SetsProfilePhotoFromUrl;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasDefaultTenant, HasTenants
{
    use HasApiTokens;
    use HasTenants;
    use HasConnectedAccounts;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use SetsProfilePhotoFromUrl;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->belongsToTenant($tenant);
    }

    public function getTenants(Panel $panel): array | Collection
    {
        return $this->allTenants();
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->currentTenant;
    }

    public function getFilamentAvatarUrl(): string
    {
        return $this->profile_photo_url;
    }
}
