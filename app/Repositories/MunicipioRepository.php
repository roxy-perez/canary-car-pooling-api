<?php

namespace App\Repositories;

use App\Interfaces\MunicipioRepositoryInterface;
use App\Models\Municipio;

class MunicipioRepository implements MunicipioRepositoryInterface
{
    public function index()
    {
        return Municipio::all();
    }

    public function getById($id)
    {
        return Municipio::findOrFail($id);
    }

    public function getByCode($code)
    {
        return Municipio::where('code', $code)->first();
    }

    public function store(array $data)
    {
        return Municipio::create($data);
    }

    public function update(array $data, $id)
    {
        return Municipio::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Municipio::destroy($id);
    }
}
