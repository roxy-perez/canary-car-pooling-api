<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function index();
    public function findById($id);
    public function findByEmail($email): ?User;
    public function create(array $data);
    public function update($id, array $data,);
    public function delete($id);
}
