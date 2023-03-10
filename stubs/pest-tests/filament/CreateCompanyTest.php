<?php

use App\Models\User;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Http\Livewire\CreateCompanyForm;

test('companies can be created', function () {
    $this->actingAs($user = User::factory()->withPersonalCompany()->create());

    Livewire::test(CreateCompanyForm::class)
                ->set(['state' => ['name' => 'Test Company']])
                ->call('createCompany');

    expect($user->fresh()->ownedCompanies)->toHaveCount(2);
    expect($user->fresh()->ownedCompanies()->latest('id')->first()->name)->toEqual('Test Company');
});
