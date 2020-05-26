<?php

namespace App\Policies;

use App\Interview;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterviewPolicy
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

    public function view(User $user, Interview $interview)
    {
        return $user->id === $interview->invitee->id;
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
