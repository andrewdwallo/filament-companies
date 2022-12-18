<?php

use Wallo\FilamentCompanies\Features;

return [
    'stack' => 'filament',
    'middleware' => ['web'],
    'features' => [Features::accountDeletion()],
    'profile_photo_disk' => 'public',
];
