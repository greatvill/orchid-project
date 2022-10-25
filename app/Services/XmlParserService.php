<?php

namespace App\Services;

use App\Parsers\ParserInterface;
use App\Repositories\NewsRepositoryInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Client\ClientInterface;

class XmlParserService
{
    private string $url;
    const CHUNCK = 1000;

    public function __construct(
        protected ClientInterface $client,
        protected NewsRepositoryInterface $newsRepository,
        protected ParserInterface $parser,
    )
    {
        $this->url = env('SOURCE_LINK');
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function parse(): void
    {
        $response = $this->client->get($this->url);
        $content = $response->getBody()->getContents();
        $items = $this->parser->parse($content)->toArray();
        $itemsChunked = array_chunk($items, self::CHUNCK);
        foreach ($itemsChunked as $rows) {
            $this->insertMany($rows);
        }
    }

    protected function insertOneByOne($insert): void
    {
        foreach ($insert as $item) {
            try {
                $this->newsRepository->insert($item->toArray());
            } catch (\Throwable $e) {
                Log::error($e->getMessage());
            }
        }
    }

    protected function insertMany(array $rows): void
    {
        try {
            $this->newsRepository->insertMany($rows);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->insertOneByOne($rows);
        }
    }
}
