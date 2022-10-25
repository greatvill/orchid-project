<?php

namespace App\Repositories;

use App\Dto\NewsDto;
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
        $insert = [];
        foreach ($rows as $row) {
            if ($row instanceof NewsDto) {
                $insert[] = $row->toArray();
            } elseif (is_array($row)) {
                $insert[] = array_filter($row);
            }
        }
        $this->model->newQuery()->insert($insert);
    }

    public function get()
    {
        // TODO: Implement get() method.
    }

    public function insert(NewsDto|array $data)
    {
        if ($data instanceof NewsDto) {
            $data = $data->toArray();
        }
        $this->model->newQuery()->insert(array_filter($data));
    }
}
