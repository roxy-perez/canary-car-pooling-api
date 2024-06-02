<?php

namespace App\Interfaces;

interface CarRepositoryInterface
{
    public function index();
    public function getById($id);
    public function getByUser($userId);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
