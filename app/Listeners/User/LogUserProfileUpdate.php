<?php

namespace App\Listeners\User;

use App\Events\User\UserProfileUpdated;

class LogUserProfileUpdate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(UserProfileUpdated $event): void
    {
        activity()
            ->causedBy($event->user)
            ->performedOn($event->user)
            ->withProperties(['attributes' => $event->changes])
            ->log('User updated their profile');
    }
}
