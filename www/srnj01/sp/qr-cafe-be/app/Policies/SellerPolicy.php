<?php

namespace App\Policies;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
        // Client can view sellers associated with their clients
        return $user->clients()->exists();
    }

    public function view(User $user, Seller $seller)
    {
        return true;
        // Client can view sellers associated with their clients
        return $user->clients->contains($seller->client);
    }

    public function create(User $user)
    {
        // Client can create sellers under their clients
        return $user->role === 'client';
    }

    public function update(User $user, Seller $seller)
    {
        // Client can update sellers associated with their clients
        return $user->clients->contains($seller->client);
    }

    public function delete(User $user, Seller $seller)
    {
        // Client can delete sellers associated with their clients
        return $user->clients->contains($seller->client);
    }
}
