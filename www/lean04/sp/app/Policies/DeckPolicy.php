<?php

namespace App\Policies;

use App\Models\Deck;
use App\Models\User;

class DeckPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Deck $deck): bool
    {
        if ($user === null) {
            return false;
        }
        return $user->id === $deck->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Deck $deck): bool
    {
        if ($user === null) {
            return false;
        }
        return $user->id === $deck->owner_id;
    }
}
