<?php

namespace App\Policies;

use App\Advertisement;
use App\Bid;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability)
    {
        return $user->is_admin ? true : null;
    }

    public function viewAny(User $user)
    {
        return $user->is_approved;
    }

    public function view(User $user, Bid $bid)
    {
        return $user->is_approved;
    }

    public function create(User $user)
    {
        return $user->is_approved;
    }

    public function update(User $user, Bid $bid)
    {
        return $user->id === $bid->user_id;
    }

    public function delete(User $user, Bid $bid)
    {
        return $user->id === $bid->user_id;
    }
}
