<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Order $order
     * @return mixed
     */
    public function restore(User $user, Order $order): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Order $order
     * @return mixed
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return $user->is_admin;
    }
}
