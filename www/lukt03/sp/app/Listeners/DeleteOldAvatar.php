<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use App\Events\UserUpdating;
use Illuminate\Support\Facades\Storage;

class DeleteOldAvatar
{
    /**
     * Handle the event.
     */
    public function handle(UserUpdating|UserDeleted $event): void
    {
        $user = $event->user;
        if (($event instanceof UserDeleted || $user->isDirty('avatar_path')) && $user->getOriginal('avatar_path') !== null) {
            Storage::delete($user->getOriginal('avatar_path'));
        }
    }
}
