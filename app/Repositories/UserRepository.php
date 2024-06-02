<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        return User::all();
    }
    public function findById($id)
    {
        return User::find($id);
    }
    public function findByEmail($email): ?User
    {
        return User::where('email', $email)->first();
    }
    public function create(array $data)
    {
        return User::create($data);
    }
    public function update(array $data, $id)
    {
        return User::find($id)->update($data);
    }
    public function delete($id)
    {
        return User::destroy($id);
    }
}
