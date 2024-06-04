<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->clients()->exists();
    }

    public function view(User $user, Account $account)
    {
        return $user->clients->contains($account->client);
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Account $account)
    {
        return $user->clients->contains($account->client);
    }

    public function delete(User $user, Account $account)
    {
        return $user->clients->contains($account->client);
    }
}
