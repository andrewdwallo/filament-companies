<?php

namespace Wallo\FilamentCompanies\Pages\User;

use Filament\Pages\Page;
use Illuminate\Http\Request;

class Profile extends Page
{
    protected static string $view = "filament-companies::filament.pages.user.profile";

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static bool $shouldRegisterNavigation = false;

    /**
     * Show the user profile screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        return view($this->view, [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

    protected function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.profile');
    }
}
