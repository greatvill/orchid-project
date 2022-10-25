<?php

namespace App\Repositories;

interface NewsRepositoryInterface
{
    public function insertMany(array $rows);

    public function get();

    public function insert(array $data);
}
