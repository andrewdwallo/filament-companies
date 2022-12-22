# Filament Companies


## Getting Started

### Installing

* This plugin requires a fresh Filament App
* No modifications need to be made to the filament config files
* Everything is set once the plugin is installed

### Executing program

* Create a fresh Laravel Project
* Configure your database
* Install the filament admin package
```
composer require filament/filament
```

* This package is in beta as some things need to be fixed
* Fork this repository to your GitHub account.
* Clone your fork in your Laravel/Filament app's root directory.
* In the `/filament-companies` directory, create a branch for your fix, e.g. `fix/error-message`.

Install the plugin/package in your app's `composer.json`:

```json
{
    ...
    "require": {
        "andrewdwallo/filament-companies": "*",
    },
    "repositories": [
        {
            "type": "path",
            "url": "filament-companies/*"
        }
    ],
    ...
}
```

Now, run `composer update`.


* Now use the following command to scaffold the app.
```
php artisan filament-companies:install filament --companies
```

* After Scaffolding is complete run the following commands. (Use either npm, pnpm, or yarn)
```
npm install
```
```
npm run build
```
```
php artisan migrate:fresh
```
```
npm run dev
```

* Go to the login page at /login by clicking register in the top right corner of the Laravel Welcome page.
* You will be redirected to the admin panel.


### Things to Note
* The package has a bug that I haven't been able to fix.
* The Current Company only updates to the last recently made company but not the current company that you switch to.. 
* I believe this might have something to do with the switchable-company.blade.php component.. but could definitely be something else.
* If you happen to find the problem I would heavily appreciate a pull request of the fix. Thanks & Happy Coding!
