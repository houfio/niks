<?php

namespace App\Policies;

use App\User;
use App\UserFavorite;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserFavoritePolicy
{
    use HandlesAuthorization;

    public function before(?User $user, string $ability)
    {
        return optional($user)->is_admin ? true : null;
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function delete(User $user, UserFavorite $model)
    {
        dd($user, $model);

        return $user->id === $model->user_id;
    }
}
