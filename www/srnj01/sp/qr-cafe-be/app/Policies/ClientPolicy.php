<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Admin can view all clients
        if ($user->role === 'admin') {
            return true;
        }

        // Client can view their associated clients
        return $user->role === 'client' && $user->clients()->exists();
    }

    public function view(User $user, Client $client)
    {
        // Admin can view any client
        if ($user->role === 'admin') {
            return true;
        }

        // Client can view their associated clients
        return $user->role === 'client' && $user->clients->contains($client);
    }

    public function create(User $user)
    {
        // Admin can create any client
        if ($user->role === 'admin') {
            return true;
        }

        // Client cannot create new clients
        return false;
    }

    public function update(User $user, Client $client)
    {
        // Admin can update any client
        if ($user->role === 'admin') {
            return true;
        }

        // Client can update their associated clients
        return $user->role === 'client' && $user->clients->contains($client);
    }

    public function delete(User $user, Client $client)
    {
        // Admin can delete any client
        if ($user->role === 'admin') {
            return true;
        }

        // Client can delete their associated clients
        return $user->role === 'client' && $user->clients->contains($client);
    }
}
