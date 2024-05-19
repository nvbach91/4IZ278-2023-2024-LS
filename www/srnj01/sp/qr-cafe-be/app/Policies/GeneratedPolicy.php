<?php

namespace App\Policies;

use App\Models\Generated;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneratedPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->clients()->exists();
    }

    public function view(User $user, Generated $generated)
    {
        return $user->clients->contains($generated->seller->client);
    }

    public function create(User $user)
    {
        return true; // Creation allowed with seller's hash
    }

    public function update(User $user, Generated $generated)
    {
        return $user->clients->contains($generated->seller->client);
    }

    public function delete(User $user, Generated $generated)
    {
        return $user->clients->contains($generated->seller->client);
    }
}
