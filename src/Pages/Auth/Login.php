<?php

namespace Wallo\FilamentCompanies\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Login as FilamentLogin;
use Wallo\FilamentCompanies\FilamentCompanies;

class Login extends FilamentLogin
{
    public static string $view = 'filament-companies::auth.login';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data')
            ->model(FilamentCompanies::userModel());
    }
}
