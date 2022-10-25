<?php

namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;

class ListNewsDto implements Arrayable
{
    /**
     * @var NewsDto[]
     */
    public array $newsDto;

    public function toArray()
    {
        return $this->newsDto;
    }

    public function add(NewsDto $dto)
    {
        $this->newsDto[] = $dto;
    }
}
