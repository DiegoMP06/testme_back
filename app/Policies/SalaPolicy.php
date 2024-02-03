<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SalaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->cargo_id === 2 || $user->cargo_id === 3;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sala $sala): bool
    {
        return $user->id === $sala->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->cargo_id === 2 || $user->cargo_id === 3;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sala $sala): bool
    {
        return $user->id === $sala->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sala $sala): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Sala $sala): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Sala $sala): bool
    {
        //
    }
}
