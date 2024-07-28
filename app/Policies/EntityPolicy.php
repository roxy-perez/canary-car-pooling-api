<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntityPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view any models.
   */
  public function viewAny(?User $user): bool
  {
    // Todos los usuarios pueden ver la lista de entidades
    return true;
  }

  /**
   * Determine whether the user can view the model.
   */
  public function view(?User $user, $entity): bool
  {
    // Todos los usuarios pueden ver una entidad específica
    return true;
  }

  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool
  {
    // Solo los administradores pueden crear entidades
    return $user->role === 'admin';
  }

  /**
   * Determine whether the user can update the model.
   */
  public function update(User $user, $entity): bool
  {
    // Solo los administradores pueden actualizar entidades
    return $user->role === 'admin';
  }

  /**
   * Determine whether the user can delete the model.
   */
  public function delete(User $user, $entity): bool
  {
    // Solo los administradores pueden eliminar entidades
    return $user->role === 'admin';
  }

  /**
   * Determine whether the user can restore the model.
   */
  public function restore(User $user, $entity): bool
  {
    // Solo los administradores pueden restaurar entidades
    return $user->role === 'admin';
  }

  /**
   * Determine whether the user can permanently delete the model.
   */
  public function forceDelete(User $user, $entity): bool
  {
    // Solo los administradores pueden eliminar permanentemente entidades
    return $user->role === 'admin';
  }
}
