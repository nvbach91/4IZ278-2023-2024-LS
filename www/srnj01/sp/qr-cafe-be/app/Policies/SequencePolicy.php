<?php

namespace App\Policies;

use App\Models\Sequence;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SequencePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->clients()->exists();
    }

    public function view(User $user, Sequence $sequence)
    {
        return $user->clients()->exists();
    }

    public function create(User $user)
    {
        return $user->clients()->exists();
    }

    public function update(User $user, Sequence $sequence)
    {
        return $user->clients()->exists();
    }

    public function delete(User $user, Sequence $sequence)
    {
        return $user->clients()->exists();
    }
}
