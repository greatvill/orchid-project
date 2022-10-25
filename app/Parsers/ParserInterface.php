<?php

namespace App\Parsers;

use App\Dto\ListNewsDto;

interface ParserInterface
{
    public function parse(string $content): ListNewsDto;
}
