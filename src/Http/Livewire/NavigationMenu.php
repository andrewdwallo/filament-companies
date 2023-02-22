<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class NavigationMenu extends Component
{
    /**
     * The component's listeners.
     *
     * @var array<string, string>
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::dropdown.navigation-menu');
    }
}
