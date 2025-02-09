<?php

namespace Wallo\FilamentTenants\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Login as FilamentLogin;
use Wallo\FilamentTenants\FilamentTenants;

class Login extends FilamentLogin
{
    public static string $view = 'filament-tenants::auth.login';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data')
            ->model(FilamentTenants::userModel());
    }
}
