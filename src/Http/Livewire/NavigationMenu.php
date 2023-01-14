<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class NavigationMenu extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    public function render(): View
    {
        return view('filament-companies::dropdown.navigation-menu');
    }
}
