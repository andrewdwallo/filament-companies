<?php

use Wallo\FilamentCompanies\Features;
use Wallo\FilamentCompanies\Http\Middleware\AuthenticateSession;

return [

    /*
    |--------------------------------------------------------------------------
    | Company Stack
    |--------------------------------------------------------------------------
    |
    | This configuration value informs Company which "stack" you will be
    | using for your application. In general, this value is set for you
    | during installation and will not need to be changed after that.
    |
    */

    'stack' => 'livewire',

    /*
     |--------------------------------------------------------------------------
     | Company Route Middleware
     |--------------------------------------------------------------------------
     |
     | Here you may specify which middleware Company will assign to the routes
     | that it registers with the application. When necessary, you may modify
     | these middleware; however, this default value is usually sufficient.
     |
     */

    'middleware' => ['web'],

    'auth_session' => AuthenticateSession::class,

    /*
    |--------------------------------------------------------------------------
    | Company Guard
    |--------------------------------------------------------------------------
    |
    | Here you may specify the authentication guard Company will use while
    | authenticating users. This value should correspond with one of your
    | guards that is already present in your "auth" configuration file.
    |
    */

    'guard' => 'sanctum',

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of Company's features are optional. You may disable the features
    | by removing them from this array. You're free to only remove some of
    | these features or you can even remove all of these if you need to.
    |
    */

    'features' => [
        Features::termsAndPrivacyPolicy(),
        Features::profilePhotos(),
        Features::api(),
        Features::companies(['invitations' => true]),
        Features::accountDeletion(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Profile Photo Disk
    |--------------------------------------------------------------------------
    |
    | This configuration value determines the default disk that will be used
    | when storing profile photos for your application's users. Typically
    | this will be the "public" disk but you may adjust this if needed.
    |
    */

    'profile_photo_disk' => 'public',

];
