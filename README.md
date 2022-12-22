![Screenshot_20221221_111616](https://user-images.githubusercontent.com/104294090/209055363-6bfefe27-12d3-4377-8a31-a2249408261b.png)
![Screenshot_20221221_111649](https://user-images.githubusercontent.com/104294090/209055364-bb1e37a9-6eff-4572-b836-1690b2642b42.png)
![Screenshot_20221221_111743](https://user-images.githubusercontent.com/104294090/209055365-9924d38b-61db-4e20-a981-784cab595a80.png)
![Screenshot_20221221_111835](https://user-images.githubusercontent.com/104294090/209055367-e8928278-ca2c-4d7a-ba99-455ed31f2aaa.png)
![Screenshot_20221221_111914](https://user-images.githubusercontent.com/104294090/209055369-af8ab8e7-cf3e-4c17-91ec-a6846b705462.png)
![Screenshot_20221221_112010](https://user-images.githubusercontent.com/104294090/209055370-535fba8b-8972-4384-9145-5086cb8eef07.png)
![Screenshot_20221221_112025](https://user-images.githubusercontent.com/104294090/209055371-447718fe-e591-464f-8f15-674af9e6480d.png)
![Screenshot_20221221_112048](https://user-images.githubusercontent.com/104294090/209055373-289b561c-389f-4e4b-b69b-b73b1a6367b9.png)
![Screenshot_20221221_112124](https://user-images.githubusercontent.com/104294090/209055374-21e18d5b-4c9c-4608-af30-a17216f09f51.png)
![Screenshot_20221221_112156](https://user-images.githubusercontent.com/104294090/209055375-a6e0dee6-bf10-487e-ab25-a69524fec524.png)
# Filament Companies


## Getting Started

### Features

* Authentication via Laravel Fortify
* Registration
* Login
* Profile Management
* Two-factor Authentication
* Browser Sessions
* API via Laravel Sanctum
* Company Creation (similar to Teams)

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
        "andrewdwallo/filament-companies": "dev-main",
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

Now, run `composer update`.


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


### Things to Note
* The package has a bug that I haven't been able to fix.
* The Current Company only updates to the last recently made company but not the current company that you switch to.. 
* I believe this might have something to do with the switchable-company.blade.php component.. but could definitely be something else.
* If you happen to find the problem I would heavily appreciate a pull request of the fix. Thanks & Happy Coding!
