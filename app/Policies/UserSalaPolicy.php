<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\User;
use App\Models\UserSala;
use Illuminate\Auth\Access\Response;

class UserSalaPolicy
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
    public function view(User $user, UserSala $userSala): bool
    {
        
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Sala $sala): bool
    {
        return $sala->acceso === 1 && $sala->user_id !== $user->id && !$sala->existeEnlace() && $sala->numAlumnos() < $sala->num_alumnos;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserSala $userSala): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserSala $userSala, Sala $sala): bool
    {
        return $sala->user_id !== $user->id && $sala->existeEnlace();
    }
}
