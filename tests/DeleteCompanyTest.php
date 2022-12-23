<?php

namespace Wallo\FilamentCompanies\Tests;

use App\Actions\FilamentCompanies\CreateCompany;
use App\Actions\FilamentCompanies\DeleteCompany;
use App\Models\Company;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Wallo\FilamentCompanies\Actions\ValidateCompanyDeletion;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Tests\Fixtures\CompanyPolicy;
use Wallo\FilamentCompanies\Tests\Fixtures\User;

class DeleteCompanyTest extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Gate::policy(Company::class, CompanyPolicy::class);
        FilamentCompanies::useUserModel(User::class);
    }

    public function test_company_can_be_deleted()
    {
        $this->migrate();

        $company = $this->createCompany();

        $action = new DeleteCompany;

        $action->delete($company);

        $this->assertNull($company->fresh());
    }

    public function test_company_deletion_can_be_validated()
    {
        FilamentCompanies::useUserModel(User::class);

        $this->migrate();

        $company = $this->createCompany();

        $action = new ValidateCompanyDeletion;

        $action->validate($company->owner, $company);

        $this->assertTrue(true);
    }

    public function test_personal_company_cant_be_deleted()
    {
        $this->expectException(ValidationException::class);

        FilamentCompanies::useUserModel(User::class);

        $this->migrate();

        $company = $this->createCompany();

        $company->forceFill(['personal_company' => true])->save();

        $action = new ValidateCompanyDeletion;

        $action->validate($company->owner, $company);
    }

    public function test_non_owner_cant_delete_company()
    {
        $this->expectException(AuthorizationException::class);

        FilamentCompanies::useUserModel(User::class);

        $this->migrate();

        $company = $this->createCompany();

        $action = new ValidateCompanyDeletion;

        $action->validate(User::forceCreate([
            'name' => 'Dan Harrin',
            'email' => 'danharrin@filament.com',
            'password' => 'secret',
        ]), $company);
    }

    protected function createCompany()
    {
        $action = new CreateCompany;

        $user = User::forceCreate([
            'name' => 'Andrew Wallo',
            'email' => 'andrewdwallo@gmail.com',
            'password' => 'secret',
        ]);

        return $action->create($user, ['name' => 'Test Company']);
    }

    protected function migrate()
    {
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }
}
