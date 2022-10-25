<?php

namespace App\Parsers;

use App\Dto\ListNewsDto;
use App\Dto\NewsDto;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class SimpleXMLAdapter implements ParserInterface
{

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function parse(string $content): ListNewsDto
    {
        try {
            $dom = new SimpleXMLElement($content);
            $items = $dom->channel->item ?? [];
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
                    'guid' => $element->guid,
                ]));
            }
            return $result;
        } catch (\Throwable $e) {
            Log::error($e);
            throw $e;
        }
    }
}
