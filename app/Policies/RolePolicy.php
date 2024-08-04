<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    public function create(User $user)
    {
        // Solo los usuarios con el rol de 'admin' pueden crear roles
        return $user->role->name === 'admin';
    }

    public function update(User $user)
    {
        // Solo los usuarios con el rol de 'admin' pueden actualizar roles
        return $user->role->name === 'admin';
    }

    public function delete(User $user)
    {
        // Solo los usuarios con el rol de 'admin' pueden eliminar roles
        return $user->role->name === 'admin';
    }
}
