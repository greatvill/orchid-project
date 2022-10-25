<?php

namespace App\Dto;

class ListNewsDto implements DtoInterface
{
    /**
     * @var $list NewsDto[]
     */
    public function __construct(protected array $list = [])
    {
    }

    public function add(NewsDto $dto): void
    {
        $this->list[] = $dto;
    }

    public function toArray(): array
    {
        return $this->list;
    }
}
