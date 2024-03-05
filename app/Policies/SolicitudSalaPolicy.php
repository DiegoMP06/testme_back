<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\SolicitudSala;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SolicitudSalaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SolicitudSala $solicitudSala, Sala $sala): bool
    {
        return ($user->cargo_id === 2 || $user->cargo_id === 3) && $sala->user_id !== $user->id && !$sala->existeEnlace() && $sala->numProfesores() < $sala->num_profesores;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, User $profesor, Sala $sala): bool
    {
        return ($profesor->cargo_id === 2 || $profesor->cargo_id === 3) && !$profesor->estaEnlazado($sala->id) && $sala->user_id !== $profesor->id && $sala->numProfesores() < $sala->num_profesores;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SolicitudSala $solicitudSala): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SolicitudSala $solicitudSala, Sala $sala): bool
    {
        return ($user->cargo_id === 2 || $user->cargo_id === 3) && $sala->user_id !== $user->id && !$sala->existeEnlace() && $sala->numProfesores() < $sala->num_profesores;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SolicitudSala $solicitudSala): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SolicitudSala $solicitudSala): bool
    {
        //
    }
}
