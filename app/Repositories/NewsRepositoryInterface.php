<?php

namespace App\Repositories;

use App\Dto\NewsDto;

interface NewsRepositoryInterface
{
    public function insertMany(array $rows);

    public function get();

    public function insert(NewsDto|array $data);
}
