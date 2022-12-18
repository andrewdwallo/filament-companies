<?php

namespace Wallo\FilamentCompanies\Tests;

use App\Actions\FilamentCompanies\CreateCompany;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\OwnerRole;
use Wallo\FilamentCompanies\Role;
use Wallo\FilamentCompanies\Tests\Fixtures\User as UserFixture;

class HasCompaniesTest extends OrchestraTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        FilamentCompanies::$permissions = [];
        FilamentCompanies::$roles = [];

        FilamentCompanies::useUserModel(UserFixture::class);
    }

    public function test_companyRole_returns_an_OwnerRole_for_the_company_owner(): void
    {
        $company = Company::factory()->create();

        $this->assertInstanceOf(OwnerRole::class, $company->owner->companyRole($company));
    }

    public function test_companyRole_returns_the_matching_role(): void
    {
        FilamentCompanies::role('admin', 'Admin', [
            'read',
            'create',
        ])->description('Admin Description');

        $company = Company::factory()
            ->hasAttached(User::factory(), [
                'role' => 'admin',
            ])
            ->create();
        $role = $company->users->first()->companyRole($company);

        $this->assertInstanceOf(Role::class, $role);
        $this->assertSame('admin', $role->key);
    }

    public function test_companyRole_returns_null_if_the_user_does_not_belong_to_the_company(): void
    {
        $company = Company::factory()->create();

        $this->assertNull((new UserFixture())->companyRole($company));
    }

    public function test_companyRole_returns_null_if_the_user_does_not_have_a_role_on_the_site(): void
    {
        $company = Company::factory()
            ->has(User::factory())
            ->create();

        $this->assertNull($company->users->first()->companyRole($company));
    }

    public function test_companyPermissions_returns_all_for_company_owners(): void
    {
        $company = Company::factory()->create();

        $this->assertSame(['*'], $company->owner->companyPermissions($company));
    }

    public function test_companyPermissions_returns_empty_for_non_employees(): void
    {
        $company = Company::factory()->create();

        $this->assertSame([], (new UserFixture())->companyPermissions($company));
    }

    public function test_companyPermissions_returns_permissions_for_the_users_role(): void
    {
        FilamentCompanies::role('admin', 'Admin', [
            'read',
            'create',
        ])->description('Admin Description');

        $company = Company::factory()
            ->hasAttached(User::factory(), [
                'role' => 'admin',
            ])
            ->create();

        $this->assertSame(['read', 'create'], $company->users->first()->companyPermissions($company));
    }

    public function test_companyPermissions_returns_empty_permissions_for_employees_without_a_defined_role(): void
    {
        FilamentCompanies::role('admin', 'Admin', [
            'read',
            'create',
        ])->description('Admin Description');

        $company = Company::factory()
            ->has(User::factory())
            ->create();

        $this->assertSame([], $company->users->first()->companyPermissions($company));
    }
}
