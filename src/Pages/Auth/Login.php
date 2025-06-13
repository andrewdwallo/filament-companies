<?php

namespace Wallo\FilamentCompanies\Pages\Auth;

use Filament\Schemas\Schema;
use Wallo\FilamentCompanies\FilamentCompanies;

class Login extends \Filament\Auth\Pages\Login
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data')
            ->model(FilamentCompanies::userModel());
    }
}
