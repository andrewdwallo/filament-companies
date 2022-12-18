<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Database\Eloquent\Model;

class CompanyInvitation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'role',
    ];

    /**
     * Get the company that the invitation belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(FilamentCompanies::companyModel());
    }
}
