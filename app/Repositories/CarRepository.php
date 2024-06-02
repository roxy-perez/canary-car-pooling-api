<?php

namespace App\Repositories;

use App\Models\Car;
use App\Interfaces\CarRepositoryInterface;

class CarRepository implements CarRepositoryInterface
{
    public function index()
    {
        return Car::all();
    }

    public function getById($id)
    {
        return Car::find($id);
    }

    public function getByUser($userId)
    {
        return Car::where('user_id', $userId)->get();
    }

    public function store(array $data)
    {
        return Car::create($data);
    }

    public function update(array $data, $id)
    {
        return Car::find($id)->update($data);
    }

    public function delete($id)
    {
        return Car::destroy($id);
    }
}
