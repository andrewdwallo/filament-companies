![gif (1)](https://user-images.githubusercontent.com/104294090/221399175-add7c34b-4887-49b7-9061-6781f6391409.gif)
<p align="center">
    <a href="https://filamentphp.com/docs/3.x/panels/installation">
        <img alt="FILAMENT 3.x" src="https://img.shields.io/badge/FILAMENT-3.x-EBB304?style=for-the-badge">
    </a>
    <a href="https://packagist.org/packages/andrewdwallo/filament-tenants">
        <img alt="Packagist" src="https://img.shields.io/packagist/v/andrewdwallo/filament-tenants.svg?style=for-the-badge&logo=packagist">
    </a>
    <a href="https://packagist.org/packages/andrewdwallo/filament-tenants/stats">
        <img alt="Downloads" src="https://img.shields.io/packagist/dt/andrewdwallo/filament-tenants?style=for-the-badge&logo=packagist&logoColor=red&color=red">
    </a>
</p>

<hr style="background-color: #ebb304">

# Filament Tenants

A comprehensive multi-tenant authentication and authorization solution designed for Filament, with a focus on tenant-based tenancy.

- 🔥 **Socialite**
- 🔥 **Terms & Privacy Policy**
- 🔥 **Password Reset via Email**
- 🔥 **Personal Profile Management**
- 🔥 **Browser Session Management**
- 🔥 **Sanctum**
- 🔥 **Tenant Management**
- 🔥 **Employee Invitations via Email**
- 🔥 **Roles & Permissions**

# Getting Started

* Create a fresh Laravel Project
* Configure your database
* Install the [Panel Builder](https://filamentphp.com/docs/3.x/panels/installation#installation)

After installing the Panel Builder, make sure that you have created a panel using the following command:
```shell
php artisan filament:install --panels
```
> 📝 If you've followed the Panel Builder documentation, you should have already done this.

# Installation

Install the package
```shell
composer require andrewdwallo/filament-tenants
```

Execute the following Artisan command to scaffold the application. You will be prompted to choose between installing the **Base package** or enabling **Socialite** support.

```shell
php artisan filament-tenants:install
```

Run migrations:
```shell
php artisan migrate:fresh
```

# Preparing Your Application

### Demo

If you encounter any issues while setting up your application with this package, you can refer to an example implementation here: [Filament Tenants Example App](https://github.com/andrewdwallo/filament-tenants-example-app).

### Creating a Theme

After installation, there will be a tenant panel registered for your application. It is located within the `FilamentTenantsServiceProvider.php` file.

In order for Tailwind to process the CSS used within this package and for the tenant panel, a user must [create a custom theme](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme). 

To create a custom theme for the tenant panel, you can use the following command:
```shell
php artisan make:filament-theme tenant
```
> 🛠️ Please follow the instructions in the console to complete the setup process

Here is a reference to the instructions that should show after running the command:
```shell
⇂ First, add a new item to the `input` array of `vite.config.js`: `resources/css/filament/tenant/theme.css`  
⇂ Next, register the theme in the tenant panel provider using `->viteTheme('resources/css/filament/tenant/theme.css')`  
⇂ Finally, run `npm run build` to compile the theme
```

After completing the process for creating a custom theme for the tenant panel, add this package's vendor directory into the content array of the `tailwind.config.js` file that should be located in the `resources/css/filament/tenant/` directory of your application:
```js
export default {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/andrewdwallo/filament-tenants/resources/views/**/*.blade.php', // The package's vendor directory
    ],
    // ...
}
```

### The User Panel

As you may have noticed, after installation, there will be a tenant panel registered for your application. In order for this package to work you must also have a "User" panel to contain the Profile page and Personal Access Tokens page.

For this example, I will use the default panel that Filament provides when installing the panel builder, the "Admin" panel.

In your "Admin" panel, make sure to register the following pages:
```php
use Wallo\FilamentTenants\Pages\User\PersonalAccessTokens;
use Wallo\FilamentTenants\Pages\User\Profile;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->pages([
            Profile::class,
            PersonalAccessTokens::class,
        ])
}
```
> 🛑 You may create a separate User Panel following the documentation for [creating a new panel](https://filamentphp.com/docs/3.x/panels/configuration#creating-a-new-panel)

You must provide a way for your users to navigate to the Profile and Personal Access Tokens pages.

It would also be wise to allow your users to navigate back to the Tenant Panel. 

You may use the following as a guide:
```php
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Auth;
use Wallo\FilamentTenants\Pages\User\PersonalAccessTokens;
use Wallo\FilamentTenants\Pages\User\Profile;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->userMenuItems([
            'profile' => MenuItem::make()
                ->label('Profile')
                ->icon('heroicon-o-user-circle')
                ->url(static fn () => url(Profile::getUrl())),
            MenuItem::make()
                ->label('Tenant')
                ->icon('heroicon-o-building-office')
                ->url(static fn () => url(Pages\Dashboard::getUrl(panel: 'tenant', tenant: Auth::user()->personalTenant()))),
        ])
        ->navigationItems([
            NavigationItem::make('Personal Access Tokens')
                ->label(static fn (): string => __('filament-tenants::default.navigation.links.tokens'))
                ->icon('heroicon-o-key')
                ->url(static fn () => url(PersonalAccessTokens::getUrl())),
        ])
}
```

You may change the value used for the User Panel using the `id` of the panel:
```php
use Filament\Panel;
use Wallo\FilamentTenants\FilamentTenants;

class FilamentTenantsServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentTenants::make()
                    ->userPanel('user')
            )
    }
}
```
> 🚧 Make sure to create a panel with the id you're passing

### The Default Panel

If you want users to directly access the Tenant panel's Register or Login page from the Laravel Welcome page, ensure the Tenant panel is set as the default in Filament. This involves two key steps:

1. Remove Default from User Panel: Ensure the User panel or any previously default panel does not use the `->default()` method. 
2. Set Tenant Panel as Default: Apply the `->default()` method to your Tenant panel configuration to make it the default entry point.

By making the Tenant panel the default, links to Register or Login on the Laravel Welcome page will lead directly to the Tenant panel's authentication pages.

### Translations and Views

If you wish to translate the package, you may publish the language files using:
```shell
php artisan vendor:publish --tag=filament-tenants-translations
```

If you wish to customize the views, you may publish them using:
```shell
php artisan vendor:publish --tag=filament-tenants-views
```

# Usage & Configuration

### Switching the Current Tenant

Filament has a built-in event that is fired when the application needs to set the tenant for the current request. This event is `Filament\Events\TenantSet`. If you would like to either enable or disable the ability to switch the current tenant, you may do so by using the `switchCurrentTenant()` method in your `FilamentTenantsServiceProvider` class.

```php
use Filament\Panel;
use Wallo\FilamentTenants\FilamentTenants;

class FilamentTenantsServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentTenants::make()
                    ->switchCurrentTenant()
            );
    }
}
```

## Configuring Profile Features

You can selectively enable or disable certain profile features. If you choose to omit a feature, it will be considered as disabled (`false`) by default.

To do so, modify your `FilamentTenantsServiceProvider` class as shown below:

```php
use Filament\Panel;
use Wallo\FilamentTenants\FilamentTenants;

class FilamentTenantsServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentTenants::make()
                    ->updateProfileInformation()  // Enables updating profile information
                    ->updatePasswords()           // Enables password updates
                    ->setPasswords()              // Enables setting passwords only if Socialite is enabled
                    ->connectedAccounts()         // Enables connected account management only if Socialite is enabled
                    ->manageBrowserSessions()     // Enables browser session management
                    ->accountDeletion()           // Enables account deletion
            );
    }
}
```

### Customizing Components

Personalize your application by replacing default components with your own custom components. This is done by passing your custom component's class name to the component parameter of the relevant method.

**Important:** Your custom component must have a unique class name. This is crucial to prevent conflicts and ensure proper functioning, as Livewire differentiates components primarily by their class names. Even if your custom component is in a different namespace, having the same class name as a component in the package can lead to unexpected errors and behavior.

Here's an example of how to use a custom component for updating profile information:

```php
use App\Livewire\CustomComponent;

FilamentTenants::make()
    ->updateProfileInformation(component: CustomComponent::class);
```

### Sorting Components

If you would like to change the order of the profile features, you may do so by setting the `sort` parameter to the corresponding method. 

The default sort order is as follows:

```php
FilamentTenants::make()
    ->updateProfileInformation(sort: 0)
    ->updatePasswords(sort: 1)
    ->setPasswords(sort: 2)
    ->connectedAccounts(sort: 3)
    ->manageBrowserSessions(sort: 4)
    ->accountDeletion(sort: 5);
```

### Adding Components

If you would like to add custom profile components, you may do so by passing the component class name along with the sort order to the `addProfileComponents()` method:

```php
use App\Livewire\CustomComponent;

FilamentTenants::make()
    ->addProfileComponents([
        7 => CustomComponent::class,
    ]);
```

Within your component's view, you may use the grid section component to match the style of other components:

```blade
<x-filament-tenants::grid-section md="2">
    <x-slot name="title">
        {{ __('My Custom Component') }}
    </x-slot>

    <x-slot name="description">
        {{ __('This is my custom component.') }}
    </x-slot>

    <x-filament::section>
        <x-filament-panels::form wire:submit="submit">
            {{ $this->form }}

            <div class="text-left">
                <x-filament::button type="submit">
                    {{ __('Save') }}
                </x-filament::button>
            </div>
        </x-filament-panels::form>
    </x-filament::section>
</x-filament-tenants::grid-section>
```

## Profile Photos

To allow users to upload custom profile photos, you can enable this feature by including the `profilePhotos()` method in your `FilamentTenantsServiceProvider`.
```php
use Filament\Panel;
use Wallo\FilamentTenants\FilamentTenants;

class FilamentTenantsServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentTenants::make()
                    ->profilePhotos()
            )
    }
}
```

### Disk Storage

By default, the package uses Laravel's `public` disk for storing images. However, you can specify a different disk by passing the `disk` parameter.
```php
FilamentTenants::make()
    ->profilePhotos(disk: 's3')
```

### Storage Path

If you want to store profile photos in a specific directory, you can set the `storagePath` parameter.
```php
FilamentTenants::make()
    ->profilePhotos(storagePath: 'profile-avatars')
```

## Modals

To adjust the layout and behavior of modals, use the `modals()` method. Below are the package's default settings:
```php
use Filament\Panel;
use Wallo\FilamentTenants\FilamentTenants;

class FilamentTenantsServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentTenants::make()
                    ->modals(
                        width: '2xl', 
                        alignment: 'center', 
                        formActionsAlignment: 'center', 
                        cancelButtonAction: false
                    )
            );
    }
}
```

## Notifications

To configure the notifications that are sent by the package, use the `notifications()` method.

Unless specified otherwise, the package will send notifications. In order to disable notifications, you must pass `false` to the `notifications()` method.

```php
use Filament\Panel;
use Wallo\FilamentTenants\FilamentTenants;

class FilamentTenantsServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentTenants::make()
                    ->notifications(condition: false)
            );
    }
}
```

### Overriding Notifications

To override the default notifications sent by the package, you should provide the following methods for each corresponding action.

The parameters passed to each method are optional and may be omitted if not needed.

#### Update User Profile Information

```php
\App\Actions\FilamentTenants\UpdateUserProfileInformation::class

/** @method void profileInformationUpdated(\Illuminate\Foundation\Auth\User|null $user = null, array|null $input = null) */
```

#### Update User Password

```php
\App\Actions\FilamentTenants\UpdateUserPassword::class

/** @method void passwordUpdated(\Illuminate\Foundation\Auth\User|null $user = null, array|null $input = null) */
```

#### Set User Password

```php
\App\Actions\FilamentTenants\SetUserPassword::class

/** @method void passwordSet(\Illuminate\Foundation\Auth\User|null $user, array|null $input = null) */
```

#### Update Tenant Name

```php
\App\Actions\FilamentTenants\UpdateTenantName::class

/** @method void tenantNameUpdated(\Illuminate\Foundation\Auth\User|null $user = null, \Illuminate\Database\Eloquent\Model|null $tenant = null, array|null $input = null) */
```

#### Invite Tenant Employee

```php
\App\Actions\FilamentTenants\InviteTenantEmployee::class

/** @method void employeeInvitationSent(\Illuminate\Foundation\Auth\User|null $user = null, \Illuminate\Database\Eloquent\Model|null $tenant = null, string|null $email = null, string|null $role = null) */
```

#### Delete Tenant

```php
\App\Actions\FilamentTenants\DeleteTenant::class

/** @method void tenantDeleted(\Illuminate\Database\Eloquent\Model|null $tenant = null) */
```

#### Example

If you would like to override the notification that is sent when a user updates their password, you may do the following:
```php
<?php

namespace App\Actions\FilamentTenants;

use App\Models\User;
use Filament\Notifications\Notification;
use Wallo\FilamentTenants\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
       // ...
    }

    public function passwordUpdated(): void
    {
        Notification::make()
            ->title('Password Updated')
            ->body('Your password has been updated.')
            ->success();
            ->send();
    }
    
}
```

## Tenant Invitations

### AutoAcceptInvitiation

If `->autoAcceptInvitations()` is set, users will join Tenants automatically on registration, as long as a invitation with their emailadress exists. If not set, they will be asked to create a personal Tenant first.
```php
    FilamentTenants::make()
        ->tenants(invitations: true)
        ->autoAcceptInvitations()
```


### Example - Send Invitation Mail via Gmail SMTP

1. **Sign in** to your account

2. **Go** to [App passwords](https://myaccount.google.com/apppasswords)

3. **Click** on "Select app", enter name of Application, and then click "Generate".

4. **Copy** your app password and store it somewhere safe.

6. **Add** the credentials in your application's `.env` file:
```dosini
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=yourgmailusername@gmail.com
MAIL_PASSWORD=of9f9279g924792g49t          
MAIL_ENCRYPTION=tls                         
MAIL_FROM_ADDRESS="filament@tenant.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Roles & Permissions

You may change the roles & permissions in `app/Providers/FilamentTenantsServiceProvider.php`
```php
/**
 * Configure the roles and permissions that are available within the application.
 */
protected function configurePermissions(): void
{
    FilamentTenants::defaultApiTokenPermissions(['read']);

    FilamentTenants::role('admin', 'Administrator', [
        'create',
        'read',
        'update',
        'delete',
    ])->description('Administrator users can perform any action.');

    FilamentTenants::role('editor', 'Editor', [
        'read',
        'create',
        'update',
    ])->description('Editor users have the ability to read, create, and update.');
}
```

## Socialite

By Default, the GitHub Provider will be enabled.

You may use any Provider that [Laravel Socialite](https://laravel.com/docs/10.x/socialite/) supports.

You may add or remove any Provider in the tenant panel configuration:
```php
use Filament\Panel;
use Wallo\FilamentTenants\FilamentTenants;
use Wallo\FilamentTenants\Enums\Feature;
use Wallo\FilamentTenants\Enums\Provider;

class FilamentTenantsServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentTenants::make()
                    ->socialite(
                        providers: [
                            Provider::Github,
                            Provider::Gitlab,
                            Provider::Google,
                            Provider::Facebook,
                            Provider::Linkedin,
                            Provider::LinkedinOpenId,
                            Provider::Bitbucket,
                            Provider::Slack,
                            Provider::Twitter,
                            Provider::TwitterOAuth2,
                        ],
                        features: [
                            Feature::RememberSession,
                            Feature::ProviderAvatars,
                            Feature::GenerateMissingEmails,
                            Feature::LoginOnRegistration,
                            Feature::CreateAccountOnFirstLogin,
                        ]
                    )
            )
    }
}
```
> ⚠️ If Twitter is desired, you may only use either Twitter OAuth1 or Twitter OAuth2. 

Pass your Provider's credentials in the provider's array in `config/services.php`:
```php
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'https://filament.test/tenant/oauth/github/callback',
    ],
```
> ‼️ The Provider's Redirect URI must look similar to the above (e.g. 'APP_URL/tenant/oauth/provider/callback')

### Example - GitHub

1. Register a [new OAuth application](https://github.com/settings/applications/new)

2. Application name
```
Filament
```

3. Homepage URL
```
http://filament.test/tenant
```

4. Authorization callback URL
```
http://filament.test/tenant/oauth/github/callback
```

5. ☑ Enable Device Flow

6. Click on **Register application**

7. **Copy** the Client Secret & **store** somewhere safe

8. **Add** the Client ID and Client Secret in `.env`
```dosini
GITHUB_CLIENT_ID=aluffgef97f9f79f434t
GITHUB_CLIENT_SECRET=hefliueoioffbo8338yhf2p9f4g2gg33
```

## Methodology

- The following examples are a visual representation of the features this package supports that were provided by the methods implemented in Laravel Jetstream.
- You may find all of the features as provided by the package [in the documentation](https://jetstream.laravel.com/3.x/features/teams.html).
- Information about a User's tenants may be accessed via the methods provided by the `Wallo\FilamentTenants\HasTenants` trait.
- This trait is automatically applied to your application's `App\Models\User` model during installation.
- This trait provides a variety of helpful methods that allow you to inspect a User's tenants or tenant:

```php
// Access a user's currently selected tenant...
$user->currentTenant : Wallo\FilamentTenants\Tenant

// Access all of the tenants (including owned tenants) that a user belongs to...
$user->allTenants() : Illuminate\Support\Collection

// Access all of a user's owned tenants...
$user->ownedTenants : Illuminate\Database\Eloquent\Collection

// Access all of the tenants that a user belongs to but does not own...
$user->tenants : Illuminate\Database\Eloquent\Collection

// Access a user's "personal" tenant...
$user->personalTenant() : Wallo\FilamentTenants\Tenant

// Determine if a user owns a given tenant...
$user->ownsTenant($tenant) : bool

// Determine if a user belongs to a given tenant...
$user->belongsToTenant($tenant) : bool

// Get the role that the user is assigned on the tenant...
$user->tenantRole($tenant) : \Wallo\FilamentTenants\Role

// Determine if the user has the given role on the given tenant...
$user->hasTenantRole($tenant, 'admin') : bool

// Access an array of all permissions a user has for a given tenant...
$user->tenantPermissions($tenant) : array

// Determine if a user has a given tenant permission...
$user->hasTenantPermission($tenant, 'server:create') : bool
```
> 📘 $user represents the current user of the application. Interchangeable with `Auth::user()`

## Credits

- [Laravel Jetstream](https://jetstream.laravel.com/introduction.html)
- [Socialstream](https://docs.socialstream.dev/)

## Notice
* If you have any questions please ask
* PR's and Issues are welcome
* If you have a general question and not an issue please ask in either my package's [Discord Channel](https://discord.com/channels/883083792112300104/1059008724410310767) or make a discussion post.

## Contributing
* Fork this repository to your GitHub account.
* Create a fresh Laravel & Filament Project.
* Clone your fork in your App's root directory.
* In the `/filament-tenants` directory, create a branch for your fix, e.g. `fix/error-message`.

Install the package in your application's `composer.json` file, using the `dev` prefix followed by your branch's name:
```json
{
    ...
    "require": {
        "andrewdwallo/filament-tenants": "dev-fix/error-message",
    },
    "repositories": [
        {
            "type": "path",
            "url": "filament-tenants/"
        }
    ],
    ...
}
```

Now, run `composer update` and continue by following the installation instructions above.
