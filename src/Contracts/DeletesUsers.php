<?php

namespace Wallo\FilamentCompanies\Contracts;

interface DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user);
}
