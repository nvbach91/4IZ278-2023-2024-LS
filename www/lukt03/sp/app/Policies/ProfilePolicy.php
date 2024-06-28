<?php

namespace App\Policies;

use App\Models\User;

class ProfilePolicy extends AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $otherUser): bool
    {
        return $user->id === $otherUser->id || $otherUser->isSitter();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $otherUser): bool
    {
        return $user->id === $otherUser->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $otherUser): bool
    {
        return $user->id === $otherUser->id;
    }
}
