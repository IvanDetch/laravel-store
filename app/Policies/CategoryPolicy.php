<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Category $category
     * @return mixed
     */
    public function restore(User $user, Category $category): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Category $category
     * @return mixed
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return $user->is_admin;
    }
}
