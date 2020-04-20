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
        return optional($user)->is_admin && optional($user)->is_approved ? true : null;
    }

    public function viewAny(User $user) {
        return true;
    }

    public function view(User $user, Intake $intake)
    {
        return $user->id === $intake->invitee->id || ($user->is_admin && $user->is_approved);
    }

    public function create(User $user) {
        return true;
    }

    public function delete(User $user) {
        return true;
    }
}
