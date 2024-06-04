<?php

namespace App\Policies;

use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApiKeyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->clients()->exists();
    }

    public function view(User $user, ApiKey $apiKey)
    {
        return $user->clients->contains($apiKey->account->client);
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, ApiKey $apiKey)
    {
        return $user->clients->contains($apiKey->account->client);
    }

    public function delete(User $user, ApiKey $apiKey)
    {
        return $user->clients->contains($apiKey->account->client);
    }
}
