<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\TestSala;
use App\Models\TestVersion;
use App\Models\User;
use App\Models\VisitaSala;
use Illuminate\Auth\Access\Response;

class VisitaSalaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Object $objeto, TestSala $testSala, $testVersion = false): bool
    {
        if($testVersion) return $objeto->id === $testSala->test_version_id && $objeto->test->user_id === $user->id;
        else return $testSala->testVersion->publico === 1 || $user->id === $testSala->testVersion->test->user_id && $objeto->id === $testSala->sala_id && $objeto->existeEnlace();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, VisitaSala $visitaSala, TestVersion $testVersion, TestSala $testSala): bool
    {
        return $user->id === $testVersion->test->user_id && $visitaSala->test_sala_id === $testSala->id && $testSala->test_version_id === $testVersion->id;
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
