<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{

  public function all()
  {
    return Role::all();
  }

  public function find($id)
  {
    return Role::findOrFail($id);
  }

  public function create(array $data)
  {
    return Role::create($data);
  }

  public function update($id, array $data)
  {
    return Role::findOrFail($id)->update($data);
  }

  public function delete($id)
  {
    return Role::find($id)->delete();
  }
}
