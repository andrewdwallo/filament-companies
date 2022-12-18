<?php

namespace Wallo\FilamentCompanies\Tests;

use Laravel\Fortify\FortifyServiceProvider;
use Wallo\FilamentCompanies\Features;
use Wallo\FilamentCompanies\FilamentCompaniesServiceProvider;
use Mockery;
use Orchestra\Testbench\TestCase;

abstract class OrchestraTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    protected function getPackageProviders($app)
    {
        return [FilamentCompaniesServiceProvider::class, FortifyServiceProvider::class];
    }

    protected function defineEnvironment($app)
    {
        $app['migrator']->path(__DIR__.'/../database/migrations');

        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function defineHasCompanyEnvironment($app)
    {
        $features = $app->config->get('filament-companies.features', []);

        $features[] = Features::companies(['invitations' => true]);

        $app->config->set('filament-companies.features', $features);
    }
}
