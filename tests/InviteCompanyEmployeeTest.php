<?php

namespace Wallo\FilamentCompanies\Tests;

use App\Actions\FilamentCompanies\CreateCompany;
use App\Actions\FilamentCompanies\InviteCompanyEmployee;
use App\Models\Company;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Tests\Fixtures\CompanyPolicy;
use Wallo\FilamentCompanies\Tests\Fixtures\User;

class InviteCompanyEmployeeTest extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Gate::policy(Company::class, CompanyPolicy::class);

        FilamentCompanies::useUserModel(User::class);
    }

    public function test_company_employees_can_be_invited()
    {
        Mail::fake();

        FilamentCompanies::role('admin', 'Admin', ['foo']);

        $this->migrate();

        $company = $this->createCompany();

        $otherUser = User::forceCreate([
            'name' => 'Dan Harrin',
            'email' => 'danharrin@filament.com',
            'password' => 'secret',
        ]);

        $action = new InviteCompanyEmployee;

        $action->invite($company->owner, $company, 'danharrin@filament.com', 'admin');

        $company = $company->fresh();

        $this->assertCount(0, $company->users);
        $this->assertCount(1, $company->companyInvitations);
        $this->assertEquals('danharrin@filament.com', $company->companyInvitations->first()->email);
        $this->assertEquals($company->id, $company->companyInvitations->first()->company->id);
    }

    public function test_user_cant_already_be_on_company()
    {
        Mail::fake();

        $this->expectException(ValidationException::class);

        $this->migrate();

        $company = $this->createCompany();

        $otherUser = User::forceCreate([
            'name' => 'Dan Harrin',
            'email' => 'danharrin@filament.com',
            'password' => 'secret',
        ]);

        $action = new InviteCompanyEmployee;

        $action->invite($company->owner, $company, 'danharrin@filament.com', 'admin');
        $this->assertTrue(true);
        $action->invite($company->owner, $company->fresh(), 'danharrin@filament.com', 'admin');
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
