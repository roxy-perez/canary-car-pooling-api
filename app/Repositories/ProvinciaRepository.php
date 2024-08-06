<?php

namespace App\Repositories;

use App\Interfaces\ProvinciaRepositoryInterface;
use App\Models\Provincia;

class ProvinciaRepository implements ProvinciaRepositoryInterface
{
    public function index()
    {
        return Provincia::all();
    }

    public function getById($id)
    {
        return Provincia::findOrFail($id);
    }

    public function getByCode($code)
    {
        return Provincia::where('code', $code)->first();
    }

    public function store(array $data)
    {
        return Provincia::create($data);
    }

    public function update(array $data, $id)
    {
        return Provincia::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Provincia::destroy($id);
    }

    public function getMunicipios($provincia)
    {
        return Provincia::where('code', $provincia)->get();
    }
}
