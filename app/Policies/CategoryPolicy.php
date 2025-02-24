<?php

namespace App\Policies;

use App\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability)
    {
        return $user->is_admin ? true : null;
    }

    public function viewAny(User $user)
    {
        return false;
    }

    public function create(?User $user)
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
