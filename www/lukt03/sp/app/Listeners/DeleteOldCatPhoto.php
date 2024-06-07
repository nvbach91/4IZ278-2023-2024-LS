<?php

namespace App\Listeners;

use App\Events\CatDeleted;
use App\Events\CatUpdating;
use Illuminate\Support\Facades\Storage;

class DeleteOldCatPhoto
{
    /**
     * Handle the event.
     */
    public function handle(CatUpdating|CatDeleted $event): void
    {
        $cat = $event->cat;
        if (($event instanceof CatDeleted || $cat->isDirty('photo_path')) && $cat->getOriginal('photo_path') !== null) {
            Storage::delete($cat->getOriginal('photo_path'));
        }
    }
}
