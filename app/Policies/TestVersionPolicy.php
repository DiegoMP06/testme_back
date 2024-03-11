<?php

namespace App\Policies;

use App\Models\Test;
use App\Models\TestVersion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestVersionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Test $test): bool
    {
        return $test->user_id === $user->id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TestVersion $testVersion, Test $test): bool
    {
        return $user->id === $test->user_id && $testVersion->test_id === $test->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TestVersion $testVersion, Test $test): bool
    {
        return $user->id === $test->user_id && $testVersion->test_id === $test->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TestVersion $testVersion, Test $test): bool
    {
        return $user->id === $test->user_id && $testVersion->test_id === $test->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TestVersion $testVersion): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TestVersion $testVersion): bool
    {
        //
    }
}
