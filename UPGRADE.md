# Upgrade Guide

## Upgrading from FilamentTenants 3.x to 4.x

This major release introduces significant changes designed to streamline the usage of FilamentTenants. Here’s how to migrate your project from 3.x to 4.x.

### Breaking Changes

1. Removal of Classes:
   - `Wallo\FilamentTenants\Features`
   - `Wallo\FilamentTenants\Providers`
   - `Wallo\FilamentTenants\Socialite`

2. Introduction of Enums:
   - Functionality previously available through the `Providers` class has been replaced by the `Wallo\FilamentTenants\Enums\Provider` enum.
   - Some functionality previously available through the `Socialite` class has been replaced by the `Wallo\FilamentTenants\Enums\Feature` enum.

3. Removal of the `MakeUserCommand` command.
   - It isn't necessary and was removed to simplify the package.

### Migration Steps

#### Dependency Versions

You should first make sure you follow the [Laravel 11 Upgrade Guide](https://laravel.com/docs/11.x/upgrade) and then upgrade your `andrewdwallo/filament-tenants` dependency to `^4.0` within your application's `composer.json` file. Then, run the `composer update` command:

    composer update

#### Socialite Providers

For Socialite providers, replace the usage of the `Wallo\FilamentTenants\Providers` class with the `Wallo\FilamentTenants\Enums\Provider` enum.

Before:

```php

use Wallo\FilamentTenants\Providers;

// Enable the following Socialite providers.
Providers::github(),
// And so on for the other providers...

// Determine if the following Socialite providers are enabled.
Providers::hasGithub(),
// And so on for the other providers...
```

After:

```php

use Wallo\FilamentTenants\Enums\Provider;

// Enable the following Socialite providers.
Provider::Github,
// And so on for the other providers...

// Determine if the following Socialite providers are enabled.
Provider::Github->isEnabled(),
// And so on for the other providers...

```

#### Socialite Features

For Socialite features, replace the usage of the `Wallo\FilamentTenants\Socialite` class with the `Wallo\FilamentTenants\Enums\Feature` enum.

Before:

```php

use Wallo\FilamentTenants\Socialite;

// Enable the following features.
Socialite::rememberSession(),
// And so on for the other features...

// Determine if the following features are enabled.
Socialite::hasRememberSessionFeature(),
// And so on for the other features...

```

After:

```php

use Wallo\FilamentTenants\Enums\Feature;

// Enable the following features.
Feature::RememberSession,
// And so on for the other features...

// Determine if the following features are enabled.
Feature::RememberSession->isEnabled(),
// And so on for the other features...
```

### Important Notes
> The rest of the methods previously available in the `Socialite` and `Features` classes are still available and were moved to the main `Wallo\FilamentTenants\FilamentTenants` class.

### Further Assistance
Should you encounter any issues during the upgrade process, please don’t hesitate to reach out Discord or by creating a new Discussion on GitHub.
