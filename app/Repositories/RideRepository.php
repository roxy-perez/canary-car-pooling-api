<?php

namespace App\Repositories;

use App\Models\Ride;
use App\Interfaces\RideRepositoryInterface;

class RideRepository implements RideRepositoryInterface
{
  public function all()
  {
    return Ride::all();
  }

  public function find($id)
  {
    return Ride::findOrFail($id);
  }

  public function create(array $data)
  {
    return Ride::create($data);
  }

  public function update(array $data, $id)
  {
    $ride = Ride::findOrFail($id);
    $ride->update($data);
    return $ride;
  }

  public function delete($id)
  {
    Ride::destroy($id);
  }
}
