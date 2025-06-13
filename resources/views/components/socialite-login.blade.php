@if (Wallo\FilamentCompanies\FilamentCompanies::hasSocialiteFeatures())
    <x-filament-companies::socialite :error-message="$errors->first('filament-companies')" />
@endif
