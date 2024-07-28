<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserCar;

class UserCarPolicy
{
  /**
   * Determine whether the user can delete the relationship.
   */
  public function delete(User $user, UserCar $userCar): bool
  {
    // Solo el propietario de la relación puede eliminarla
    return $user->id === $userCar->user_id;
  }
}
