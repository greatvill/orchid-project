<?php

namespace App\Repositories;

use App\Dto\ListNewsDto;
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

    public function insertMany(array|ListNewsDto $rows)
    {
        $insert = [];
        if ($rows instanceof ListNewsDto) {
            $rows = $rows->toArray();
        }
        foreach ($rows as $row) {
            if ($row instanceof NewsDto) {
                $insert[] = $row->toArray();
            } elseif (is_array($row)) {
                $insert[] = array_filter($row);
            }
        }
        $this->model->newQuery()->insert($insert);
    }

    public function get(array $select = [], array $where = [], int $limit = 30): ListNewsDto
    {
        $list = $this->model->newQuery()
            ->select($select)
            ->where($where)
            ->limit($limit)
            ->orderByDesc('id')
            ->get()
            ->map(function (News $item) {
                $ats = $item->only([
                    'title',
                    'link',
                    'description',
                    'pub_date',
                    'author',
                    'image',
                    'created_at',
                    'guid',
                ]);
                return NewsDto::createFromArray($ats);
            })->all();

        return new ListNewsDto($list);
    }

    public function insert(NewsDto|array $data)
    {
        if ($data instanceof NewsDto) {
            $data = $data->toArray();
        }
        $this->model->newQuery()->insert(array_filter($data));
    }
}
