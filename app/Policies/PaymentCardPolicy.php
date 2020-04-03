<?php

namespace App\Policies;

use App\TransactionLog;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionLogPolicy
{
    use HandlesAuthorization;

    public function getLog(User $user, ?TransactionLog $userId): bool
    {
        return $user->id === $userId || $user->isAdmin();
    }
}
