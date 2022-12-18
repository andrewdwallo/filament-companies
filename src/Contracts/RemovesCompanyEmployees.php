<?php

namespace Wallo\FilamentCompanies\Contracts;

interface RemovesCompanyEmployees
{
    /**
     * Remove the company employee from the given company.
     *
     * @param  mixed  $user
     * @param  mixed  $company
     * @param  mixed  $companyEmployee
     * @return void
     */
    public function remove($user, $company, $companyEmployee);
}
