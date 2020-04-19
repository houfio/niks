<?php

namespace App\Policies;

use App\Intake;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IntakePolicy
{
    use HandlesAuthorization;

    public function before(?User $user, string $ability)
    {
        return optional($user)->is_admin ? true : null;
    }

    public function view(User $user, Intake $intake)
    {
        return $user->id === $intake->invitee->id;
    }
}
