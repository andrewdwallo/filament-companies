![gif (1)](https://user-images.githubusercontent.com/104294090/221399175-add7c34b-4887-49b7-9061-6781f6391409.gif)
<p align="center">
    <a href="https://filamentadmin.com/docs/2.x/admin/installation">
        <img alt="FILAMENT 3.x" src="https://img.shields.io/badge/FILAMENT-3.x-EBB304?style=for-the-badge">
    </a>
    <a href="https://packagist.org/packages/andrewdwallo/filament-companies">
        <img alt="Packagist" src="https://img.shields.io/packagist/v/andrewdwallo/filament-companies.svg?style=for-the-badge&logo=packagist">
    </a>
    <a href="https://packagist.org/packages/andrewdwallo/filament-companies">
        <img alt="Downloads" src="https://img.shields.io/packagist/dt/andrewdwallo/filament-companies?color=red&style=for-the-badge" >
    </a>
</p>

<hr style="background-color: #ebb304">

# Filament Companies

A Complete Authentication System Kit based on Companies built for Filament:
- :fire: **Authentication - Fortify** 
- :fire: **Socialite (Optional)**
- :fire: **Terms & Privacy Policy**
- :fire: **Password Reset via Email**
- :fire: **Personal Profile Management**
- :fire: **Two-Factor Authentication (2FA)**
- :fire: **Browser Session Management**
- :fire: **Sanctum API**
- :fire: **Company Management**
- :fire: **Employee Invitations via Email**
- :fire: **Roles & Permissions**
- :fire: **And More to Come!**

# Getting Started

### Note
* Example application using package: https://github.com/andrewdwallo/erpsaas/tree/1.x

### Getting Set Up

* Create a fresh Laravel Project
* Configure your database
* Install the filament panel package

# Installation

Install this package
```shell
composer require andrewdwallo/filament-companies
```

After installing the package, you may execute the `filament-companies:install` Artisan command. This command requires the name of the stack to be `filament` and the option to be `--companies`. In addition, you may use the `--socialite` switch to enable socialite support.

Use one of the following commands to scaffold the application: 
```shell
php artisan filament-companies:install filament --companies

php artisan filament-companies:install filament --companies --socialite
```

### Finalizing Installation

```shell
php artisan migrate:fresh
```

Run the following command to install Tailwind CSS with the Tailwind Forms and Typography plugins:
```shell
npm install tailwindcss @tailwindcss/forms @tailwindcss/typography postcss autoprefixer --save-dev
```

Create a postcss.config.js file in the root of your project and register Tailwind CSS and Autoprefixer as plugins:
```js
export default {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
}
```

Update your Vite configuration:
```js
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filament/company/theme.css',
            ],
            refresh: true,
        }),
    ],
});
```

Run the following to compile your assets and the company theme:
```
npm run build
npm run dev
```

After installation, there will be a company panel registered for your application. In order for this package to work you must also have a "User" panel in order to have a profile page and personal access tokens page.

For this example, I will use the default panel that Filament provides when installing the panel package, the "Admin" panel.

In your "Admin" panel, make sure to register the following pages:
```php
->pages([
    Profile::class,
    PersonalAccessTokens::class,
])
```

Register the following items as well:
```php
->userMenuItems([
    'profile' => MenuItem::make()
        ->label('Profile')
        ->icon('heroicon-o-user-circle')
        ->url(static fn () => url(Profile::getUrl())),
    MenuItem::make()
        ->label('Company')
        ->icon('heroicon-o-building-office')
        ->url(static fn () => url(Pages\Dashboard::getUrl(panel: 'company', tenant: Auth::user()->personalCompany()))),
])
->navigationItems([
    NavigationItem::make('APITokens')
        ->label(static fn (): string => __('filament-companies::default.navigation.links.tokens'))
        ->icon('heroicon-o-key')
        ->url(static fn () => url(PersonalAccessTokens::getUrl())),
])
```
>They may be configured in the way you like but as long as they are registered.

### Translations and Views

If you wish to translate the package, you may publish the language files using:
```shell
php artisan vendor:publish --tag=filament-companies-translations
```

If you wish to customize the views, you may publish them using:
```shell
php artisan vendor:publish --tag=filament-companies-views
```

# Usage

If you would like, you may create a new account using:
```shell
php artisan make:filament-companies-user
```
> You may also create a new account by registering through the application.

This package is extensively "borrowed" from the work of Taylor Otwell, his contributors and the Laravel Jetstream package. You can get a full understanding of the capabilities by reviewing the Jetstream [Documentation](https://jetstream.laravel.com/2.x/introduction.html/).

### Socialite

By Default, the GitHub Provider will be enabled.

You may use any Provider that [Laravel Socialite](https://laravel.com/docs/10.x/socialite/) supports.

You may add or remove any Provider in the company panel configuration:
```php
->plugin(
    FilamentCompanies::make()
        ->userPanel('admin')
        ->profilePhotos()
        ->api()
        ->companies(invitations: true)
        ->termsAndPrivacyPolicy()
        ->accountDeletion()
        ->socialite(
            providers: ['github', 'gitlab', 'google', 'facebook', 'linkedin', 'bitbucket', 'twitter', 'twitter-oauth-2'],
            features: ['rememberSession','providerAvatars']
        )
)
```
> If Twitter is desired, you may only use either Twitter OAuth1 or Twitter OAuth2, not both. 

In `config/services.php` pass your Provider's credentials in the providers array:
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
> The Provider's Redirect URI must look similar to the above (e.g. 'APP_URL/company/oauth/provider_name/callback')

An Example: How to Set Up GitHub (using Filament as Application Name & APP_URL)
1. Go to https://github.com/settings/applications/new
2. Application Name: `Filament`
3. Homepage URL: `https://filament.test/company`
4. Authorization callback URL: `https://filament.test/company/oauth/github/callback`
5. Click on Device Flow & Save
6. Copy the Client Secret & store somewhere safe.
> Authorization callback URL = 'redirect' from above

In the `.env` file, for example:
```dosini
GITHUB_CLIENT_ID=aluffgef97f9f79f434t
GITHUB_CLIENT_SECRET=hefliueoioffbo8338yhf2p9f4g2gg33
```

The Socialite package is extensively "borrowed" from the work of Joel Butcher, his contributors and the Socialstream package. You can get a full understanding of the capabilities by reviewing the Socialstream [Documentation](https://docs.socialstream.dev/).

The following examples are a visual representation of the features this package supports that were provided by the methods implemented in Laravel Jetstream. You may find all of the features as provided by the Laravel Jetstream package [here](https://jetstream.laravel.com/3.x/features/teams.html) in their documentation.

Information about a user's companies may be accessed via the methods provided by the `Wallo\FilamentCompanies\HasCompanies` trait. This trait is automatically applied to your application's `App\Models\User` model during installation. This trait provides a variety of helpful methods that allow you to inspect a user's companies or company:

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
> $user represents the current user of the application. Interchangeable with `Auth::user()`

### Company Invitations
In my opinion, if you are using GMAIL & you are testing, this is the easiest route to setup the Mail Server:
1. Go to https://myaccount.google.com/apppasswords (May ask you to Sign in)
2. Click on "Select app", enter name of Application, then click "Generate".
3. Copy your app password and store it somewhere safe.

In your application's `.env` file, for example:
```dosini
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=yourgmailusername@gmail.com
MAIL_PASSWORD=of9f9279g924792g49t           # GMAIL App Password
MAIL_ENCRYPTION=tsl                         # tsl is recommended over ssl
MAIL_FROM_ADDRESS="filament@company.com"
MAIL_FROM_NAME="${APP_NAME}"
```
> Port does not have to be specific

### Roles & Permissions
You may change roles & permissions in `app/Providers/FilamentCompaniesServiceProvider.php`
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

### Notice
* This package is currently in beta
* If you have any questions please ask
* PR's and Issues are welcome.
* If you have a general question and not a legitimate issue please ask in either my package's Discord or make a discussion post.

### Contributing
* Fork this repository to your GitHub account.
* Create a fresh Laravel & Filament Project.
* Clone your fork in your App's root directory.
* In the `/filament-companies` directory, create a branch for your fix, e.g. `fix/error-message`.

Install the package in your application's `composer.json` file using the `dev` prefix followed by your branches name:
```json
{
    ...
    "require": {
        "andrewdwallo/filament-companies": "*",
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

Now, run `composer update` and continue by following the installation instructions above.
