<?php

namespace App\Policies;

use App\User;
use App\UserFavorite;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserFavoritePolicy
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

    public function create(User $user)
    {
        return $user->is_approved;
    }

    public function delete(User $user, UserFavorite $favorite)
    {
        return $user->id === $favorite->user_id;
    }
}
