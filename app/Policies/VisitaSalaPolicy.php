<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\TestSala;
use App\Models\User;
use App\Models\VisitaSala;
use Illuminate\Auth\Access\Response;

class VisitaSalaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Sala $sala, TestSala $testSala): bool
    {
        return $testSala->testVersion->publico === 1 || $user->id === $testSala->testVersion->test->user_id && $sala->id === $testSala->sala_id && $sala->existeEnlace();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VisitaSala $visitaSala): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Sala $sala, TestSala $testSala): bool
    {
        return $testSala->testVersion->publico === 1 || $user->id === $testSala->testVersion->test->user_id && $sala->id === $testSala->sala_id && $sala->existeEnlace() && !$testSala->existeVisitaSala();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VisitaSala $visitaSala): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VisitaSala $visitaSala): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VisitaSala $visitaSala): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VisitaSala $visitaSala): bool
    {
        //
    }
}
