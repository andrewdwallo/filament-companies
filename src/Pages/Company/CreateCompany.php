<?php

namespace Wallo\FilamentCompanies\Pages\Company;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant as FilamentRegisterTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\Events\AddingCompany;
use Wallo\FilamentCompanies\FilamentCompanies;

class CreateCompany extends FilamentRegisterTenant
{
    protected static string $view = 'filament-companies::filament.pages.companies.create_company';

    public static function getLabel(): string
    {
        return 'Register Company';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('filament-companies::default.labels.company_name'))
                    ->autofocus()
                    ->maxLength(255)
                    ->required(),
            ])
            ->model(FilamentCompanies::companyModel())
            ->statePath('data');
    }

    protected function handleRegistration(array $data): Model
    {
        $user = Auth::user();

        Gate::forUser($user)->authorize('create', FilamentCompanies::newCompanyModel());

        AddingCompany::dispatch($user);

        $personalCompany = $user->personalCompany() === null;

        $company = $user->ownedCompanies()->create([
            'name' => $data['name'],
            'personal_company' => $personalCompany,
        ]);

        $user->switchCompany($company);

        return $company;
    }
}
