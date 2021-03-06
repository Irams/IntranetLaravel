<?php

namespace App\Policies;

use App\User;
use App\entradas;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntradaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\entradas  $entradas
     * @return mixed
     */
    public function view(User $user, entradas $entradas)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\entradas  $entradas
     * @return mixed
     */
    public function update(User $user, entradas $entradas)
    {
        //Revisa si el usuario autenticado es el mismo que creo la receta
        return $user->id === $entradas->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\entradas  $entradas
     * @return mixed
     */
    public function delete(User $user, entradas $entradas)
    {
        //Revisa si el usuario autenticado es el mismo que creo la receta
        return $user->id === $entradas->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\entradas  $entradas
     * @return mixed
     */
    public function restore(User $user, entradas $entradas)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\entradas  $entradas
     * @return mixed
     */
    public function forceDelete(User $user, entradas $entradas)
    {
        //
    }
}
