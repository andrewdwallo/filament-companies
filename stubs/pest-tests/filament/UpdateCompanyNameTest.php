<?php

use App\Models\User;
use Livewire\Livewire;
use Wallo\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm;

test('company names can be updated', function () {
    $this->actingAs($user = User::factory()->withPersonalCompany()->create());

    Livewire::test(UpdateCompanyNameForm::class, ['company' => $user->currentCompany])
                ->set(['state' => ['name' => 'Test Company']])
                ->call('updateCompanyName');

    expect($user->fresh()->ownedCompanies)->toHaveCount(1);
    expect($user->currentCompany->fresh()->name)->toEqual('Test Company');
});
