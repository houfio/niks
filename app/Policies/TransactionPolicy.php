<?php

namespace App\Policies;

use App\Transaction;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
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

    public function view(User $user, Transaction $transaction)
    {
        return false;
    }

    public function create(User $user)
    {
        return $user->is_approved;
    }

    public function update(User $user, Transaction $transaction)
    {
        return false;
    }

    public function delete(User $user, Transaction $transaction)
    {
        return false;
    }
}
