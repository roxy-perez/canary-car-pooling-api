<?php

namespace App\Interfaces;

interface MunicipioRepositoryInterface
{
    public function index();
    public function getById($id);
    public function getByCode($code);
    public function store(array $data);
    public function update(array $data, $code);
    public function delete($code);
}
