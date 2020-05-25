<?php

namespace App\Policies;

use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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

    public function view(User $user, Ticket $model)
    {
        return false;
    }

    public function create(?User $user)
    {
        return true;
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
