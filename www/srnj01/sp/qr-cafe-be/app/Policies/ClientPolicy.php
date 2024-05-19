<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return true;
    }

    public function view(User $user, Client $client)
    {
        return $user->clients->contains($client);
    }

    public function create()
    {
        return true;
    }

    public function update(User $user, Client $client)
    {
        return $user->clients->contains($client);
    }

    public function delete(User $user, Client $client)
    {
        return $user->clients->contains($client);
    }
}
