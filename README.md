![Screenshot_20221221_111616](https://user-images.githubusercontent.com/104294090/209055363-6bfefe27-12d3-4377-8a31-a2249408261b.png)
![Screenshot_20221221_111649](https://user-images.githubusercontent.com/104294090/209055364-bb1e37a9-6eff-4572-b836-1690b2642b42.png)
![Screenshot_20221221_111743](https://user-images.githubusercontent.com/104294090/209055365-9924d38b-61db-4e20-a981-784cab595a80.png)
![Screenshot_20221221_111835](https://user-images.githubusercontent.com/104294090/209055367-e8928278-ca2c-4d7a-ba99-455ed31f2aaa.png)
![Screenshot_20221221_111914](https://user-images.githubusercontent.com/104294090/209055369-af8ab8e7-cf3e-4c17-91ec-a6846b705462.png)
![Screenshot_20221231_123900](https://user-images.githubusercontent.com/104294090/210151569-ab0ccbaf-2c3e-440f-9e6f-9cceabaa0e2f.png)
![Screenshot_20221231_123950](https://user-images.githubusercontent.com/104294090/210151570-d36cfa65-aefa-4efd-a5e3-7579e7c20212.png)
![Screenshot_20221221_112048](https://user-images.githubusercontent.com/104294090/209055373-289b561c-389f-4e4b-b69b-b73b1a6367b9.png)
![Screenshot_20221221_112124](https://user-images.githubusercontent.com/104294090/209055374-21e18d5b-4c9c-4608-af30-a17216f09f51.png)
![Screenshot_20221221_112156](https://user-images.githubusercontent.com/104294090/209055375-a6e0dee6-bf10-487e-ab25-a69524fec524.png)
# Filament Companies


## Getting Started

### Features

* Authentication via Laravel Fortify
* Registration
* Login
* Terms of Service 
* Privacy Policy
* Password Reset through Mail
* Profile Management
* Two-factor Authentication
* Browser Sessions
* API via Laravel Sanctum
* Company Creation (similar to Teams)
* Employee Invitation to Company through Mail


### Installing

* This plugin requires a fresh Filament project
* If you install this plugin into an existing Filament project you will get errors
* Do not install this plugin into an existing Filament project
* No modifications need to be made to the filament config files
* Everything is set once the plugin is installed

### Executing program

* Create a fresh Laravel Project
* Configure your database
* Install the filament admin package

```
composer require filament/filament
```

* Install the package
```
composer require andrewdwallo/filament-companies
```

* Now use the following command to scaffold the app.
```
php artisan filament-companies:install filament --companies
```

* After Scaffolding is complete run the following commands. (Use either npm, pnpm, or yarn depending on what your package manager currently is before the scaffold)
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

* Go to the Register page at /register by clicking Register in the top right corner of the Laravel Welcome page.
* You will be redirected to the admin panel.
* You can create companies by clicking the dropdown navigation in the Filament topbar.
* By clicking on your current company's settings in the topbar you can manage that current company.
* You may also switch your current company.
* You can also create API Tokens and manage your personal profile settings by clicking the filament user menu dropdown link.

* You may publish the components and customize them to your liking.
```
php artisan vendor:publish --tag=filament-companies-views
```

### Usage
This package is extensively "borrowed" from the work of Taylor Otwell, his contributors and the Laravel Jetstream package. You can get a full understanding of the capabilities by reviewing the Jetstream docs:
https://jetstream.laravel.com/2.x/introduction.html

### Note
* Documentation specific to Filament will come as more modifications are made.
* This package is supposed to be a Filament Context and is planning to be used as one in Filament V3
* This is not supposed to be the "Admin" Context, this would be the view that a "company user" would see (although there are methods to support an admin context)

### Contributing
* Fork this repository to your GitHub account.
* Create a fresh Laravel & Filament Project
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
            "url": "filament-companies/"
        }
    ],
    ...
}
```

* Now, run `composer update`.
* Follow installation instructions above.

### For Contributors: A general list of things that need to be worked on/improved

#### Before Starting take note that this package is supposed to be a Filament Context and is planning to be used as one in Filament V3
#### This is not supposed to be the "Admin" Context, this would be the view that a "company user" would see

* Dark Mode support for some components
* NavigationMenu.php class component listener needs to actually refresh after a form is saved (This is connected to a render hook in FilamentCompaniesServiceProvider)
* Test need to be updated
* Any other things you notice that you would like to improve that would benefit everyone as a whole
