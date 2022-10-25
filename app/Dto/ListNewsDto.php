<?php

namespace App\Dto;

class ListNewsDto implements DtoInterface
{
    /**
     * @var NewsDto[]
     */
    public array $newsDto = [];

    public function add(NewsDto $dto): void
    {
        $this->newsDto[] = $dto;
    }

    public function toArray(): array
    {
        return $this->newsDto;
    }
}
