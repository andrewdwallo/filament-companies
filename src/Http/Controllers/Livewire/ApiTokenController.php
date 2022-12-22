<?php

namespace Wallo\FilamentCompanies\Http\Controllers\Livewire;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiTokenController extends Controller
{
    /**
     * Show the user API token screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('filament.pages.api-tokens', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
}
