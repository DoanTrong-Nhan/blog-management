<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function getAll();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

    public function getPaginated($perPage = 6, $search = null);

}
