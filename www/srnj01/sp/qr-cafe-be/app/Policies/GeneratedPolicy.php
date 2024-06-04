<?php

namespace App\Policies;

use App\Models\Generated;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneratedPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return true;
    }

    public function view()
    {
        return true;
    }

    public function create()
    {
        return true;
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
