<?php

namespace Wallo\FilamentCompanies\Tests;

use App\Actions\FilamentCompanies\CreateCompany;
use App\Actions\FilamentCompanies\RemoveCompanyEmployee;
use App\Models\Company;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Wallo\FilamentCompanies\Events\CompanyEmployeeRemoved;
use Wallo\FilamentCompanies\Events\RemovingCompanyEmployee;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Tests\Fixtures\CompanyPolicy;
use Wallo\FilamentCompanies\Tests\Fixtures\User;

class RemoveCompanyEmployeeTest extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Gate::policy(Company::class, CompanyPolicy::class);

        FilamentCompanies::useUserModel(User::class);
    }

    public function test_company_employees_can_be_removed()
    {
        Event::fake([CompanyEmployeeRemoved::class]);

        $this->migrate();

        $company = $this->createCompany();

        $otherUser = User::forceCreate([
            'name' => 'Dan Harrin',
            'email' => 'danharrin@filament.com',
            'password' => 'secret',
        ]);

        $company->users()->attach($otherUser, ['role' => null]);

        $this->assertCount(1, $company->fresh()->users);

        Auth::login($company->owner);

        $action = new RemoveCompanyEmployee;

        $action->remove($company->owner, $company, $otherUser);

        $this->assertCount(0, $company->fresh()->users);

        Event::assertDispatched(CompanyEmployeeRemoved::class);
    }

    public function test_a_company_owner_cant_remove_themselves()
    {
        $this->expectException(ValidationException::class);

        Event::fake([RemovingCompanyEmployee::class]);

        $this->migrate();

        $company = $this->createCompany();

        Auth::login($company->owner);

        $action = new RemoveCompanyEmployee;

        $action->remove($company->owner, $company, $company->owner);
    }

    public function test_the_user_must_be_authorized_to_remove_company_employees()
    {
        $this->expectException(AuthorizationException::class);

        $this->migrate();

        $company = $this->createCompany();

        $dan = User::forceCreate([
            'name' => 'Dan Harrin',
            'email' => 'danharrin@filament.com',
            'password' => 'secret',
        ]);

        $jay = User::forceCreate([
            'name' => 'Jay Wallo',
            'email' => 'jaywallo@gmail.com',
            'password' => 'secret',
        ]);

        $company->users()->attach($dan, ['role' => null]);
        $company->users()->attach($jay, ['role' => null]);

        Auth::login($company->owner);

        $action = new RemoveCompanyEmployee;

        $action->remove($dan, $company, $jay);
    }

    protected function createCompany()
    {
        $action = new CreateCompany;

        $user = User::forceCreate([
            'name' => 'Dan Harrin',
            'email' => 'danharrin@filament.com',
            'password' => 'secret',
        ]);

        return $action->create($user, ['name' => 'Test Company']);
    }

    protected function migrate()
    {
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }
}
