<?php

namespace App\Policies;

use App\Models\Sitting;
use App\Models\User;

class SittingPolicy extends AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sitting $sitting): bool
    {
        return $user->id === $sitting->sitter->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sitting $sitting): bool
    {
        return $user->id === $sitting->owner->id || $user->id === $sitting->sitter->id;
    }
}
