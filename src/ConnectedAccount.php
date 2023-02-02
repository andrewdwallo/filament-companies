<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Database\Eloquent\Model;
use Wallo\FilamentCompanies\FilamentCompanies;

abstract class ConnectedAccount extends Model
{
    /**
     * Get the credentials used for authenticating services.
     *
     * @return \Wallo\FilamentCompanies\Credentials
     */
    public function getCredentials()
    {
        return new Credentials($this);
    }

    /**
     * Get user of the connected account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(FilamentCompanies::userModel(), 'user_id');
    }

    /**
     * Get the data that should be shared with Inertia.
     *
     * @return array
     */
    public function getSharedInertiaData()
    {
        return $this->getSharedData();
    }

    /**
     * Get the data that should be shared.
     *
     * @return array
     */
    public function getSharedData()
    {
        return [
            'id' => $this->id,
            'provider' => $this->provider,
            'avatar_path' => $this->avatar_path,
            'created_at' => optional($this->created_at)->diffForHumans(),
        ];
    }
}
