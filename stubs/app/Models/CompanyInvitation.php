<?php

namespace App\Models;

use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\CompanyInvitation as FilamentCompaniesCompanyInvitation;

class CompanyInvitation extends FilamentCompaniesCompanyInvitation
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
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
