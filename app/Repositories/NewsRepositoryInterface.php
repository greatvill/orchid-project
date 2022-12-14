<?php

namespace App\Repositories;

use App\Dto\ListNewsDto;
use App\Dto\NewsDto;

interface NewsRepositoryInterface
{
    public function insertMany(ListNewsDto|array $rows);

    public function get(array $select = [], array $where = [], int $limit = 30): ListNewsDto;

    public function insert(NewsDto|array $data);
}
