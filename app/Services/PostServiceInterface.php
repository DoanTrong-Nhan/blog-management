<?php

namespace App\Services;

interface PostServiceInterface
{
    public function list();
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function find($id);
}
