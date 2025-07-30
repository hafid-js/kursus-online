<?php

use App\Events\UserProfileUpdated;
use App\Listeners\LogUserProfileUpdate;

return [
    UserProfileUpdated::class => [
        LogUserProfileUpdate::class,
    ],
];
