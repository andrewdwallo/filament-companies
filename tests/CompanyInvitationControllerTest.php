<?php

namespace Wallo\FilamentCompanies\Tests;

use App\Actions\FilamentCompanies\CreateCompany;
use App\Models\Company;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Wallo\FilamentCompanies\Contracts\AddsCompanyEmployees;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Tests\Fixtures\CompanyPolicy;
use Wallo\FilamentCompanies\Tests\Fixtures\User;

class CompanyInvitationControllerTest extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Gate::policy(Company::class, CompanyPolicy::class);
        FilamentCompanies::useUserModel(User::class);
    }

    public function test_company_invitations_can_be_accepted()
    {
        $this->mock(AddsCompanyEmployees::class)->shouldReceive('add')->once();

        FilamentCompanies::role('admin', 'Admin', ['foo', 'bar']);
        FilamentCompanies::role('editor', 'Editor', ['baz', 'qux']);

        $this->migrate();

        $company = $this->createCompany();

        $invitation = $company->companyInvitations()->create(['email' => 'adam@laravel.com', 'role' => 'admin']);

        $url = URL::signedRoute('company-invitations.accept', ['invitation' => $invitation]);

        $response = $this->actingAs($company->owner)->get($url);

        $response->assertRedirect();
    }

    protected function createCompany()
    {
        $action = new CreateCompany;

        $user = User::forceCreate([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
            'password' => 'secret',
        ]);

        return $action->create($user, ['name' => 'Test Company']);
    }

    protected function migrate()
    {
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('filament-companies.stack', 'filament');
        $app['config']->set('filament-companies.features', ['companies']);
    }
}
