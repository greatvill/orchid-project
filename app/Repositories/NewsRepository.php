<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Support\Facades\DB;

class NewsRepository implements NewsRepositoryInterface
{
    private News $model;

    public function __construct(News $model)
    {
        $this->model = $model;
    }

    public function insertMany(array $rows)
    {
        $this->model->newQuery()->insert($rows);
    }

    public function get()
    {
        // TODO: Implement get() method.
    }

    public function insert(array $data)
    {
        $this->model->newQuery()->insert($data);
    }
}
