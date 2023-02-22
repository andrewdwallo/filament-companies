<?php

namespace Wallo\FilamentCompanies\Http\Controllers\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Wallo\FilamentCompanies\FilamentCompanies;

class PrivacyPolicyController extends Controller
{
    /**
     * Show the privacy policy for the application.
     */
    public function show(Request $request): Application|Factory|View
    {
        $policyFile = FilamentCompanies::localizedMarkdownPath('policy.md');

        return view('filament-companies::policy', [
            'policy' => Str::markdown(file_get_contents($policyFile)),
        ]);
    }
}
