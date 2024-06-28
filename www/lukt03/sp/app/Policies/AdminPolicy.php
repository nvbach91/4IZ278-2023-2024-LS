<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }
}
