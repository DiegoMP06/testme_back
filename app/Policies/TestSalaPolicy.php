<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\User;
use App\Models\TestSala;
use App\Models\TestVersion;
use Illuminate\Auth\Access\Response;

class TestSalaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Object $objeto, $testVersion = false): bool
    {
        if($testVersion) return $objeto->test->user_id === $user->id;
        return $objeto->acceso === 1 || $objeto->user_id === $user->id || $objeto->existeEnlace();
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TestSala $testSala, TestVersion $testVersion): bool
    {
        return $user->id === $testVersion->test->user_id && $testSala->test_version_id === $testVersion->id;
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
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TestSala $testSala, Object $objeto, $testVersion = false): bool
    {
        if($testVersion) return $user->id === $objeto->test->user_id && $testSala->test_version_id === $objeto->id;
        return $objeto->user_id === $user->id || $testSala->esCreador();
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
