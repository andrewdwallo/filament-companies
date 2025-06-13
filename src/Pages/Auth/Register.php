<?php

namespace Wallo\FilamentCompanies\Pages\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Wallo\FilamentCompanies\FilamentCompanies;

class Register extends \Filament\Auth\Pages\Register
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                ...FilamentCompanies::hasTermsAndPrivacyPolicyFeature() ? [$this->getTermsFormComponent()] : []])
            ->statePath('data')
            ->model(FilamentCompanies::userModel());
    }

    protected function getTermsFormComponent(): Component
    {
        return Checkbox::make('terms')
            ->label(new HtmlString(__('filament-companies::default.subheadings.auth.register', [
                'terms_of_service' => $this->generateFilamentLink(Terms::getRouteName(), __('filament-companies::default.links.terms_of_service')),
                'privacy_policy' => $this->generateFilamentLink(PrivacyPolicy::getRouteName(), __('filament-companies::default.links.privacy_policy')),
            ])))
            ->validationAttribute(__('filament-companies::default.errors.terms'))
            ->accepted();
    }

    public function generateFilamentLink(string $routeName, string $label): string
    {
        return Blade::render('filament::components.link', [
            'href' => FilamentCompanies::route($routeName),
            'target' => '_blank',
            'color' => 'primary',
            'slot' => $label,
        ]);
    }
}
