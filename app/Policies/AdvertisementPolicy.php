<?php

namespace App\Policies;

use App\Advertisement;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->is_approved;
    }

    public function view(User $user, Advertisement $advertisement)
    {
        return $user->is_approved;
    }

    public function create(User $user)
    {
        return $user->is_approved;
    }

    public function update(User $user, Advertisement $advertisement)
    {
        return $user->id === $advertisement->user_id;
    }

    public function delete(User $user, Advertisement $advertisement)
    {
        return $user->id === $advertisement->user_id;
    }
}
