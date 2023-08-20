<?php

namespace Wallo\FilamentCompanies\Pages\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as FilamentRegister;
use Illuminate\Support\HtmlString;
use Wallo\FilamentCompanies\Features;
use Wallo\FilamentCompanies\FilamentCompanies;

class Register extends FilamentRegister
{
    protected static string $view = 'filament-companies::auth.register';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                ...Features::hasTermsAndPrivacyPolicyFeature() ? [$this->getTermsFormComponent()] : []])
            ->statePath('data')
            ->model(FilamentCompanies::userModel());
    }

    protected function getTermsFormComponent(): Component
    {
        return Checkbox::make('terms')
            ->label(new HtmlString(__('filament-companies::default.subheadings.auth.register', [
                'terms_of_service' => '<a target="_blank" href="'.route('filament.company.auth.terms').'" class="font-medium outline-none hover:underline focus:underline text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400">'.__('filament-companies::default.links.terms_of_service').'</a>',
                'privacy_policy' => '<a target="_blank" href="'.route('filament.company.auth.policy').'" class="font-medium outline-none hover:underline focus:underline text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400">'.__('filament-companies::default.links.privacy_policy').'</a>',
            ])))
            ->validationAttribute('Terms of Service and Privacy Policy')
            ->accepted();
    }
}
