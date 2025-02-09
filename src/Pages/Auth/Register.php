<?php

namespace Wallo\FilamentTenants\Pages\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Component;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as FilamentRegister;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Wallo\FilamentTenants\FilamentTenants;

class Register extends FilamentRegister
{
    protected static string $view = 'filament-tenants::auth.register';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                ...FilamentTenants::hasTermsAndPrivacyPolicyFeature() ? [$this->getTermsFormComponent()] : []])
            ->statePath('data')
            ->model(FilamentTenants::userModel());
    }

    protected function getTermsFormComponent(): Component
    {
        return Checkbox::make('terms')
            ->label(new HtmlString(__('filament-tenants::default.subheadings.auth.register', [
                'terms_of_service' => $this->generateFilamentLink(Terms::getRouteName(), __('filament-tenants::default.links.terms_of_service')),
                'privacy_policy' => $this->generateFilamentLink(PrivacyPolicy::getRouteName(), __('filament-tenants::default.links.privacy_policy')),
            ])))
            ->validationAttribute(__('filament-tenants::default.errors.terms'))
            ->accepted();
    }

    public function generateFilamentLink(string $routeName, string $label): string
    {
        return Blade::render('filament::components.link', [
            'href' => FilamentTenants::route($routeName),
            'target' => '_blank',
            'color' => 'primary',
            'slot' => $label,
        ]);
    }
}
