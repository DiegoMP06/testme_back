<?php

namespace App\Policies;

use App\Models\TestVersion;
use App\Models\User;
use App\Models\Visita;
use Illuminate\Auth\Access\Response;

class VisitaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, TestVersion $testVersion): bool
    {
        return $testVersion->publico === 1 || $user->id === $testVersion->test->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Visita $visita): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, TestVersion $testVersion): bool
    {
        return $testVersion->publico === 1 && $user->id !== $testVersion->test->user_id && !$testVersion->existeVisita();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Visita $visita): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Visita $visita): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Visita $visita): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Visita $visita): bool
    {
        //
    }
}
