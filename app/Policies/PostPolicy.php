<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before(?User $user, string $ability)
    {
        return optional($user)->is_admin ? true : null;
    }
}
