![gif (1)](https://user-images.githubusercontent.com/104294090/221399175-add7c34b-4887-49b7-9061-6781f6391409.gif)
<p align="center">
    <a href="https://filamentphp.com/docs/3.x/panels/installation">
        <img alt="FILAMENT 3.x" src="https://img.shields.io/badge/FILAMENT-3.x-EBB304?style=for-the-badge">
    </a>
    <a href="https://packagist.org/packages/andrewdwallo/filament-companies">
        <img alt="Packagist" src="https://img.shields.io/packagist/v/andrewdwallo/filament-companies.svg?style=for-the-badge&logo=packagist">
    </a>
    <a href="https://packagist.org/packages/andrewdwallo/filament-companies/stats">
        <img alt="Downloads" src="https://img.shields.io/packagist/dt/andrewdwallo/filament-companies?style=for-the-badge&logo=packagist&logoColor=red&color=red">
    </a>
</p>

<hr style="background-color: #ebb304">

# Filament Companies

A comprehensive multi-tenant authentication and authorization solution designed for Filament, with a focus on company-based tenancy.

- 🔥 **Socialite**
- 🔥 **Terms & Privacy Policy**
- 🔥 **Password Reset via Email**
- 🔥 **Personal Profile Management**
- 🔥 **Browser Session Management**
- 🔥 **Sanctum**
- 🔥 **Company Management**
- 🔥 **Employee Invitations via Email**
- 🔥 **Roles & Permissions**
- 🔥 **Auto-Accept Invitations**

# Getting Started

* Create a fresh Laravel Project
* Configure your database
* Install the [Panel Builder](https://filamentphp.com/docs/3.x/panels/installation#installation)

After installing the Panel Builder, ensure you create a panel using the following command:
```shell
php artisan filament:install --panels
```
> 📝 If you've followed the Panel Builder documentation, you should have already done this.

# Installation

Install the package
```shell
composer require andrewdwallo/filament-companies
```

Execute the following Artisan command to scaffold the application. You will be prompted to choose between installing the **Base package** or enabling **Socialite** support.

```shell
php artisan filament-companies:install
```

Run migrations:
```shell
php artisan migrate:fresh
```

# Preparing Your Application

### Demo

If you encounter any issues while setting up your application with this package, refer to the example implementation here: [Filament Companies Example App](https://github.com/andrewdwallo/filament-companies-example-app).

### Creating a Theme

After installation, there will be a company panel registered for your application. It is located within the `FilamentCompaniesServiceProvider.php` file.

In order for Tailwind to process the CSS used within this package and for the company panel, a user must [create a custom theme](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme). 

To create a custom theme for the company panel, you can use the following command:
```shell
php artisan make:filament-theme company
```
> 🛠️ Please follow the instructions in the console to complete the setup process

Here is a reference to the instructions that should show after running the command:
```shell
⇂ First, add a new item to the `input` array of `vite.config.js`: `resources/css/filament/company/theme.css`  
⇂ Next, register the theme in the company panel provider using `->viteTheme('resources/css/filament/company/theme.css')`  
⇂ Finally, run `npm run build` to compile the theme
```

Once the custom theme for the company panel is created, add this package's vendor directory to the `content` array in the `tailwind.config.js` file, located in `resources/css/filament/company/`:
```js
export default {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/andrewdwallo/filament-companies/resources/views/**/*.blade.php', // The package's vendor directory
    ],
    // ...
}
```

### The User Panel

As you may have noticed, after installation, there will be a company panel registered for your application. In order for this package to work you must also have a "User" panel to contain the Profile page and Personal Access Tokens page.

For this example, I will use the default panel that Filament provides when installing the panel builder, the "Admin" panel.

In your "Admin" panel, make sure to register the following pages:
```php
use Wallo\FilamentCompanies\Pages\User\PersonalAccessTokens;
use Wallo\FilamentCompanies\Pages\User\Profile;

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

Ensure users have a way to navigate to the Profile and Personal Access Tokens pages.

Users should also have a way to navigate back to the Company Panel.

You may use the following as a guide:
```php
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Auth;
use Wallo\FilamentCompanies\Pages\User\PersonalAccessTokens;
use Wallo\FilamentCompanies\Pages\User\Profile;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->userMenuItems([
            'profile' => MenuItem::make()
                ->label('Profile')
                ->icon('heroicon-o-user-circle')
                ->url(static fn () => Profile::getUrl()),
            MenuItem::make()
                ->label('Company')
                ->icon('heroicon-o-building-office')
                ->url(static fn () => Pages\Dashboard::getUrl(panel: FilamentCompanies::getCompanyPanel(), tenant: Auth::user()->personalCompany())),
        ])
        ->navigationItems([
            NavigationItem::make('Personal Access Tokens')
                ->label(static fn (): string => __('filament-companies::default.navigation.links.tokens'))
                ->icon('heroicon-o-key')
                ->url(static fn () => PersonalAccessTokens::getUrl()),
        ])
}
```

If [**Auto-Accept Invitations**](#auto-accept-invitations) is enabled, the Company menu item logic must handle cases where the user does not have a personal company to avoid errors. One way to do this is as follows:
```php
MenuItem::make()
    ->label('Company')
    ->icon('heroicon-o-building-office')
    ->url(static function (): ?string {
        $user = Auth::user();

        if ($company = $user?->primaryCompany()) {
            return Pages\Dashboard::getUrl(panel: FilamentCompanies::getCompanyPanel(), tenant: $company);
        }

        return Filament::getPanel(FilamentCompanies::getCompanyPanel())->getTenantRegistrationUrl();
    }),
```
> [!NOTE]
> This modification is necessary because, when Auto-Accept Invitations is enabled, an invited user may not have a personal company. Without this adjustment, generating a URL with a `null` tenant may cause an error.

You may change the value used for the User Panel using the `id` of the panel:
```php
use Filament\Panel;
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentCompanies::make()
                    ->userPanel('user')
            )
    }
}
```
> 🚧 Make sure to create a panel with the id you're passing

### The Default Panel

If you want users to directly access the Company panel's Register or Login page from the Laravel Welcome page, ensure the Company panel is set as the default in Filament. This involves two key steps:

1. Remove Default from User Panel: Ensure the User panel or any previously default panel does not use the `->default()` method. 
2. Set Company Panel as Default: Apply the `->default()` method to your Company panel configuration to make it the default entry point.

By making the Company panel the default, links to Register or Login on the Laravel Welcome page will lead directly to the Company panel's authentication pages.

### Translations and Views

If you wish to translate the package, you may publish the language files using:
```shell
php artisan vendor:publish --tag=filament-companies-translations
```

If you wish to customize the views, you may publish them using:
```shell
php artisan vendor:publish --tag=filament-companies-views
```

### Email Verification

If you are using [email verification](https://filamentphp.com/docs/3.x/panels/users#authentication-features) make sure to register your verify-email url. If this is not properly registerd, you may see errors on the user profile page. You can either add this via Filament's `VerifyEmail` facade or a new route in your app.

#### Registering the URL via the create URL Notification callback

Place this in your `AppServiceProvider`'s boot method:

```php
use Filament\Facades\Filament;
use Filament\Notifications\Auth\VerifyEmail;

// Verify email notification url
VerifyEmail::createUrlUsing(function ($notifiable) {
    return Filament::getVerifyEmailUrl($notifiable);
});
```

#### Registering your email verification route through a new route

Place this in routes file - typically `web.php`:

```php
use Filament\Http\Controllers\Auth\EmailVerificationController;

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, '__invoke'])
    ->middleware(['signed'])
    ->name('verification.verify');
```

# Usage & Configuration

### Switching the Current Company

Filament has a built-in event that is fired when the application needs to set the tenant for the current request. This event is `Filament\Events\TenantSet`. If you would like to either enable or disable the ability to switch the current company, you may do so by using the `switchCurrentCompany()` method in your `FilamentCompaniesServiceProvider` class.

```php
use Filament\Panel;
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentCompanies::make()
                    ->switchCurrentCompany()
            );
    }
}
```
> [!CAUTION]
> This feature is a core part of the package and should typically remain enabled. Disabling it will prevent users from switching between companies, which may not be desirable for most use cases.

## Configuring Profile Features

You can selectively enable or disable certain profile features. If a feature is omitted, it will be disabled by default.

To do so, modify your `FilamentCompaniesServiceProvider` class as shown below:

```php
use Filament\Panel;
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentCompanies::make()
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

> [!IMPORTANT]
> Your custom component must have a unique class name. This is crucial to prevent conflicts and ensure proper functioning, as Livewire differentiates components primarily by their class names. Even if your custom component is in a different namespace, having the same class name as a component in the package can lead to unexpected errors and behavior.

Here's an example of how to use a custom component for updating profile information:

```php
use App\Livewire\CustomComponent;

FilamentCompanies::make()
    ->updateProfileInformation(component: CustomComponent::class);
```

### Sorting Components

If you would like to change the order of the profile features, you may do so by setting the `sort` parameter to the corresponding method. 

The default sort order is as follows:

```php
FilamentCompanies::make()
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

FilamentCompanies::make()
    ->addProfileComponents([
        7 => CustomComponent::class,
    ]);
```

Within your component's view, you may use the grid section component to match the style of other components:

```blade
<x-filament-companies::grid-section md="2">
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
</x-filament-companies::grid-section>
```

## Profile Photos

To allow users to upload custom profile photos, you can enable this feature by including the `profilePhotos()` method in your `FilamentCompaniesServiceProvider`.
```php
use Filament\Panel;
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentCompanies::make()
                    ->profilePhotos()
            )
    }
}
```

### Disk Storage

By default, the package uses Laravel's `public` disk for storing images. However, you can specify a different disk by passing the `disk` parameter.
```php
FilamentCompanies::make()
    ->profilePhotos(disk: 's3')
```

### Storage Path

If you want to store profile photos in a specific directory, you can set the `storagePath` parameter.
```php
FilamentCompanies::make()
    ->profilePhotos(storagePath: 'profile-avatars')
```

## Modals

To adjust the layout and behavior of modals, use the `modals()` method. Below are the package's default settings:
```php
use Filament\Panel;
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentCompanies::make()
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
use Wallo\FilamentCompanies\FilamentCompanies;

class FilamentCompaniesServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentCompanies::make()
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
\App\Actions\FilamentCompanies\UpdateUserProfileInformation::class

/** @method void profileInformationUpdated(\Illuminate\Foundation\Auth\User|null $user = null, array|null $input = null) */
```

#### Update User Password

```php
\App\Actions\FilamentCompanies\UpdateUserPassword::class

/** @method void passwordUpdated(\Illuminate\Foundation\Auth\User|null $user = null, array|null $input = null) */
```

#### Set User Password

```php
\App\Actions\FilamentCompanies\SetUserPassword::class

/** @method void passwordSet(\Illuminate\Foundation\Auth\User|null $user, array|null $input = null) */
```

#### Update Company Name

```php
\App\Actions\FilamentCompanies\UpdateCompanyName::class

/** @method void companyNameUpdated(\Illuminate\Foundation\Auth\User|null $user = null, \Illuminate\Database\Eloquent\Model|null $company = null, array|null $input = null) */
```

#### Invite Company Employee

```php
\App\Actions\FilamentCompanies\InviteCompanyEmployee::class

/** @method void employeeInvitationSent(\Illuminate\Foundation\Auth\User|null $user = null, \Illuminate\Database\Eloquent\Model|null $company = null, string|null $email = null, string|null $role = null) */
```

#### Delete Company

```php
\App\Actions\FilamentCompanies\DeleteCompany::class

/** @method void companyDeleted(\Illuminate\Database\Eloquent\Model|null $company = null) */
```

#### Example

If you would like to override the notification that is sent when a user updates their password, you may do the following:
```php
<?php

namespace App\Actions\FilamentCompanies;

use App\Models\User;
use Filament\Notifications\Notification;
use Wallo\FilamentCompanies\Contracts\UpdatesUserPasswords;

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

## Company Invitations

### Auto-Accept Invitations

This feature allows invited users to bypass the personal company creation step during registration and be redirected to accept their company invitation immediately. This ensures a smoother onboarding process for employees or team members joining an existing company. 

If disabled, users must create a personal company during registration if they don’t already have one.

To enable this, configure your `FilamentCompaniesServiceProvider`:
```php
FilamentCompanies::make()
    ->companies(invitations: true)
    ->autoAcceptInvitations()
```

When enabled, invited users can register and directly join their invited company without unnecessary setup steps.

### Example - Send Invitation Mail via Gmail SMTP

1. **Sign in** to your account

2. **Go** to [App passwords](https://myaccount.google.com/apppasswords)

3. **Click** on "Select app", enter name of Application, and then click "Generate".

4. **Copy** your app password and store it somewhere safe.

6. **Add** the credentials in your application's `.env` file:
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=<YOUR_GMAIL_EMAIL>
MAIL_PASSWORD=<YOUR_GMAIL_APP_PASSWORD>  
MAIL_ENCRYPTION=tls                    
MAIL_FROM_ADDRESS=<YOUR_GMAIL_EMAIL>
MAIL_FROM_NAME="${APP_NAME}"
```

## Roles & Permissions

You may change the roles & permissions in `app/Providers/FilamentCompaniesServiceProvider.php`
```php
/**
 * Configure the roles and permissions that are available within the application.
 */
protected function configurePermissions(): void
{
    FilamentCompanies::defaultApiTokenPermissions(['read']);

    FilamentCompanies::role('admin', 'Administrator', [
        'create',
        'read',
        'update',
        'delete',
    ])->description('Administrator users can perform any action.');

    FilamentCompanies::role('editor', 'Editor', [
        'read',
        'create',
        'update',
    ])->description('Editor users have the ability to read, create, and update.');
}
```

## Socialite

By Default, the GitHub Provider will be enabled.

You may use any Provider that [Laravel Socialite](https://laravel.com/docs/10.x/socialite/) supports.

You may add or remove any Provider in the company panel configuration:
```php
use Filament\Panel;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Enums\Feature;
use Wallo\FilamentCompanies\Enums\Provider;

class FilamentCompaniesServiceProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentCompanies::make()
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
        'redirect' => 'https://filament.test/company/oauth/github/callback',
    ],
```
> ‼️ The Provider's Redirect URI must look similar to the above (e.g. 'APP_URL/company/oauth/provider/callback')

### Example - GitHub

1. Register a [new OAuth application](https://github.com/settings/applications/new)

2. Application name
```
Filament
```

3. Homepage URL
```
http://filament.test/company
```

4. Authorization callback URL
```
http://filament.test/company/oauth/github/callback
```

5. ☑ Enable Device Flow

6. Click on **Register application**

7. **Copy** the Client Secret & **store** somewhere safe

8. **Add** the Client ID and Client Secret in `.env`
```dotenv
GITHUB_CLIENT_ID=<YOUR_GITHUB_CLIENT_ID>
GITHUB_CLIENT_SECRET=<YOUR_GITHUB_CLIENT_SECRET>
```

## Methodology

- The following examples illustrate features supported by this package, inspired by methods originally implemented in Laravel Jetstream.
- Information about a user's companies can be accessed through methods provided by the `Wallo\FilamentCompanies\HasCompanies` trait.
- This trait is automatically applied to your application's `App\Models\User` model during installation.

```php
// Access a user's currently selected company...
$user->currentCompany : Wallo\FilamentCompanies\Company

// Access all of the companies (including owned companies) that a user belongs to...
$user->allCompanies() : Illuminate\Support\Collection

// Access all of a user's owned companies...
$user->ownedCompanies : Illuminate\Database\Eloquent\Collection

// Access all of the companies that a user belongs to but does not own...
$user->companies : Illuminate\Database\Eloquent\Collection

// Access a user's "personal" company...
$user->personalCompany() : Wallo\FilamentCompanies\Company

// Get the user's primary company (prioritizes personal company)...
$user->primaryCompany() : Wallo\FilamentCompanies\Company|null

// Determine if the user has any companies...
$user->hasAnyCompanies() : bool

// Determine if a user owns a given company...
$user->ownsCompany($company) : bool

// Determine if a user belongs to a given company...
$user->belongsToCompany($company) : bool

// Get the role that the user is assigned on the company...
$user->companyRole($company) : \Wallo\FilamentCompanies\Role

// Determine if the user has the given role on the given company...
$user->hasCompanyRole($company, 'admin') : bool

// Access an array of all permissions a user has for a given company...
$user->companyPermissions($company) : array

// Determine if a user has a given company permission...
$user->hasCompanyPermission($company, 'server:create') : bool
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
* In the `/filament-companies` directory, create a branch for your fix, e.g. `fix/error-message`.

Install the package in your application's `composer.json` file, using the `dev` prefix followed by your branch's name:
```json
{
    ...
    "require": {
        "andrewdwallo/filament-companies": "dev-fix/error-message",
    },
    "repositories": [
        {
            "type": "path",
            "url": "filament-companies/"
        }
    ],
    ...
}
```

Run `composer update`, then follow the installation instructions above.
