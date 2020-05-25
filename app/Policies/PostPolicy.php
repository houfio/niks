<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before(?User $user, string $ability)
    {
        return optional($user)->is_admin ? true : null;
    }

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Post $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, User $model)
    {
        return false;
    }

    public function delete(User $user, User $model)
    {
        return false;
    }
}
