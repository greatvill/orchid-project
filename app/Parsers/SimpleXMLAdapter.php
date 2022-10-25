<?php

namespace App\Parsers;

use App\Dto\ListNewsDto;
use App\Dto\NewsDto;
use SimpleXMLElement;

class SimpleXMLAdapter implements ParserInterface
{

    /**
     * @throws \Exception
     */
    public function parse(string $content): ListNewsDto
    {
        $dom = new SimpleXMLElement($content);
        $items = $dom->channel->item;
        $result = new ListNewsDto();
        foreach ($items as $element) {
            $result->add(NewsDto::createFromArray([
                'title' => $element->title ?? null,
                'link' => $element->link ?? null,
                'description' => $element->description ?? null,
                'pub_date' => $element->pubDate ?? null,
                'author' => $element->author ?? null,
                'image' => $element->enclosure->attributes()['url'] ?? null,
                'created_at' => now(),
            ]));
        }
        return $result;
    }
}
