<?php

use App\Models\User;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Livewire\Livewire;

test('other browser sessions can be logged out', function () {
    $this->actingAs($user = User::factory()->create());

    Livewire::test(LogoutOtherBrowserSessionsForm::class)
            ->set('password', 'password')
            ->call('logoutOtherBrowserSessions')
            ->assertSuccessful();
});
