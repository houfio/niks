<?php

namespace App\Policies;

use App\Intake;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IntakePolicy
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

    public function view(User $user, Intake $intake)
    {
        return $user->id === $intake->invitee->id;
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
