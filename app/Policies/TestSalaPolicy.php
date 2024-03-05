<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\TestSala;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestSalaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Sala $sala): bool
    {
        return $sala->acceso === 1 || $sala->user_id === $user->id || $sala->existeEnlace();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TestSala $testSala): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Sala $sala, $test_id): bool
    {
        return $sala->esProfesor() && !$sala->testEnlazado(($test_id));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TestSala $testSala): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TestSala $testSala, Sala $sala): bool
    {
        return $sala->user_id === $user->id || $testSala->esCreador();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TestSala $testSala): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TestSala $testSala): bool
    {
        //
    }
}
