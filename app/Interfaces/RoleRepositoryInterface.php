<?php

namespace App\Interfaces;

use App\Models\Role;

interface RoleRepositoryInterface
{
  public function all();
  public function find($id);
  public function create(array $data);
  public function update($i, array $data);
  public function delete($id);
}
