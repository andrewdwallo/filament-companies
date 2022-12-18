<?php

namespace Wallo\FilamentCompanies\Tests;

use Wallo\FilamentCompanies\Features;
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesTest extends OrchestraTestCase
{
    public function test_roles_can_be_registered()
    {
        FilamentCompanies::$permissions = [];
        FilamentCompanies::$roles = [];

        FilamentCompanies::role('admin', 'Admin', [
            'read',
            'create',
        ])->description('Admin Description');

        FilamentCompanies::role('editor', 'Editor', [
            'read',
            'update',
            'delete',
        ])->description('Editor Description');

        $this->assertTrue(FilamentCompanies::hasPermissions());

        $this->assertEquals([
            'create',
            'delete',
            'read',
            'update',
        ], FilamentCompanies::$permissions);
    }

    public function test_roles_can_be_json_serialized()
    {
        FilamentCompanies::$permissions = [];
        FilamentCompanies::$roles = [];

        $role = FilamentCompanies::role('admin', 'Admin', [
            'read',
            'create',
        ])->description('Admin Description');

        $serialized = $role->jsonSerialize();

        $this->assertArrayHasKey('key', $serialized);
        $this->assertArrayHasKey('name', $serialized);
        $this->assertArrayHasKey('description', $serialized);
        $this->assertArrayHasKey('permissions', $serialized);
    }

    public function test_has_company_feature_will_always_return_false_when_company_is_not_enabled()
    {
        $this->assertFalse(FilamentCompanies::hasCompanyFeatures());
        $this->assertFalse(FilamentCompanies::userHasCompanyFeatures(new Fixtures\User));
        $this->assertFalse(FilamentCompanies::userHasCompanyFeatures(new Fixtures\Admin));
    }

    /**
     * @define-env defineHasCompanyEnvironment
     */
    public function test_has_company_feature_can_be_determined_when_company_is_enabled()
    {
        $this->assertTrue(FilamentCompanies::hasCompanyFeatures());
        $this->assertTrue(FilamentCompanies::userHasCompanyFeatures(new Fixtures\User));
        $this->assertFalse(FilamentCompanies::userHasCompanyFeatures(new Fixtures\Admin));
    }
}
