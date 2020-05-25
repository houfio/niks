<?php

namespace App\Policies;

use App\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function before(?User $user, string $ability)
    {
        return $user->is_admin;
    }

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, Category $category)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function delete(User $user)
    {
        return false;
    }
}
