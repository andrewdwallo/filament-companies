<?php

namespace Wallo\FilamentCompanies\Tests;

use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Features;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Tests\Fixtures\User;
use Mockery as m;

class UserProfileControllerTest extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        FilamentCompanies::useUserModel(User::class);
    }

    public function test_empty_two_factor_state_is_noted()
    {
        $this->migrate();

        $disable = $this->mock(DisableTwoFactorAuthentication::class);
        $disable->shouldReceive('__invoke')->once();

        $user = User::forceCreate([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
            'password' => 'secret',
        ]);

        $response = $this->actingAs($user)->get('/user/profile');

        $response->assertSessionHas('two_factor_empty_at');

        $response->assertStatus(200);
    }

    public function test_two_factor_is_not_disabled_if_was_previously_empty_and_currently_confirming()
    {
        $this->migrate();

        $disable = $this->mock(DisableTwoFactorAuthentication::class);
        $disable->shouldReceive('__invoke')->never();

        $user = User::forceCreate([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
            'password' => 'secret',
            'two_factor_secret' => 'test-secret',
        ]);

        $response = $this->actingAs($user)
                        ->withSession(['two_factor_empty_at' => time()])
                        ->get('/user/profile');

        $response->assertStatus(200);
    }

    public function test_two_factor_is_disabled_if_was_previously_confirming_and_page_is_reloaded()
    {
        $this->migrate();

        $disable = $this->mock(DisableTwoFactorAuthentication::class);
        $disable->shouldReceive('__invoke')->once();

        $user = User::forceCreate([
            'name' => 'Taylor Otwell',
            'email' => 'taylor@laravel.com',
            'password' => 'secret',
            'two_factor_secret' => 'test-secret',
        ]);

        $response = $this->actingAs($user)
                        ->withSession([
                            'two_factor_empty_at' => time(),
                            'two_factor_confirming_at' => time() - 10,
                        ])
                        ->get('/user/profile');

        $response->assertStatus(200);
    }

    protected function migrate()
    {
        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        Schema::table('users', function ($table) {
            $table->string('two_factor_secret')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
        });
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('filament-companies.stack', 'filament');
        $app['config']->set('fortify.features', [
            Features::registration(),
            Features::resetPasswords(),
            // Features::emailVerification(),
            Features::updateProfileInformation(),
            Features::updatePasswords(),
            Features::twoFactorAuthentication([
                'confirm' => true,
                'confirmPassword' => true,
            ]),
        ]);
    }
}
