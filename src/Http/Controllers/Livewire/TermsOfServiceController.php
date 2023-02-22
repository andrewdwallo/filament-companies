<?php

namespace Wallo\FilamentCompanies\Http\Controllers\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Wallo\FilamentCompanies\FilamentCompanies;

class TermsOfServiceController extends Controller
{
    /**
     * Show the terms of service for the application.
     */
    public function show(Request $request): Application|Factory|View
    {
        $termsFile = FilamentCompanies::localizedMarkdownPath('terms.md');

        return view('filament-companies::terms', [
            'terms' => Str::markdown(file_get_contents($termsFile)),
        ]);
    }
}
