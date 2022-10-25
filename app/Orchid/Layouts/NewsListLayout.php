<?php

namespace App\Orchid\Layouts;

use App\Models\News;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NewsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = News::TABLE;

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'id'),
            TD::make('title', 'Title'),
            TD::make('link', 'link'),
            TD::make('description', 'description'),
            TD::make('pub_date', 'pub_date'),
            TD::make('author', 'author'),
            TD::make('image', 'image'),
            TD::make('created_at', 'created_at'),
            TD::make('updated_at', 'updated_at'),
        ];
    }
}
