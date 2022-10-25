<?php

namespace App\Dto;

class ListNewsDto
{
    /**
     * @var NewsDto[]
     */
    public array $newsDto;

    public function add(NewsDto $dto): void
    {
        $this->newsDto[] = $dto;
    }

    public function getNews(): array
    {
        return $this->newsDto;
    }
}
