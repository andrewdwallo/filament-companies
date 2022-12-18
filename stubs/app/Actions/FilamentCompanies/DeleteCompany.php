<?php

namespace App\Actions\FilamentCompanies;

use Wallo\FilamentCompanies\Contracts\DeletesCompanies;

class DeleteCompany implements DeletesCompanies
{
    /**
     * Delete the given company.
     *
     * @param  mixed  $company
     * @return void
     */
    public function delete($company)
    {
        $company->purge();
    }
}
