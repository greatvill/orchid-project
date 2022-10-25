<?php

namespace App\Orchid\Layouts;

use App\Models\Request;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RequestsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = Request::TABLE;

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'id'),
            TD::make('created_at', 'created_at'),
            TD::make('method', 'method'),
            TD::make('url', 'url'),
            TD::make('code', 'code'),
           // TD::make('body', 'body'),
        ];
    }
}
