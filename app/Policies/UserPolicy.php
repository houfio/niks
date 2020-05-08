<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(?User $user, string $ability)
    {
        return optional($user)->is_admin ? true : null;
    }

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, User $model)
    {
        return $user->is_approved;
    }

    public function create(?User $user)
    {
        return is_null($user);
    }

    public function update(User $user, User $model)
    {
        return $user->id === $model->id;
    }

    public function delete(User $user, User $model)
    {
        return $user->id === $model->id;
    }
}
