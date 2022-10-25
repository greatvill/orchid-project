<?php

namespace App\Dto;

use Carbon\Carbon;

class NewsDto implements DtoInterface
{
    public function __construct(public string|null $title,
                                public string|null $link,
                                public string|null $description,
                                public string|null $pubDate,
                                public string|null $author,
                                public string|null $image,
                                public Carbon|null    $createdAt,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'link' => $this->link,
            'description' => $this->description,
            'pub_date' => $this->pubDate,
            'author' => $this->author,
            'image' => $this->image,
            'created_at' => $this->createdAt,
        ];
    }

    public static function createFromArray(array $data): NewsDto
    {
        return new self(
            $data['title'],
            $data['link'],
            $data['description'],
            $data['pub_date'],
            $data['author'],
            $data['image'],
            $data['created_at']);

    }
}
