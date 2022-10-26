<?php

namespace App\Services;

use App\Clients\ClientInterface;
use App\Dto\NewsDto;
use App\Parsers\ParserInterface;
use App\Repositories\NewsRepositoryInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class ParserService
{
    private string $url;
    const CHUNCK = 1000;

    public function __construct(
        protected ClientInterface         $client,
        protected NewsRepositoryInterface $newsRepository,
        protected ParserInterface         $parser,
    )
    {
        $this->url = env('SOURCE_LINK', '');
    }

    /**
     * @throws \Exception
     */
    public function parse(): void
    {
        Log::info('Start parse');
        $content = $this->client->get($this->url);
        $newsFromParser = $this->parser->parse($content)->toArray();
        $existingGuids = $this->newsRepository->get(['guid'])->toArray();
        $existingGuids = collect($existingGuids)->map(fn(NewsDto $item) => $item->guid)->toArray();
        $newsFromParser = collect($newsFromParser)
            ->filter(fn(NewsDto $item) => !in_array($item->guid, $existingGuids, true))
            ->toArray();
        foreach (array_chunk($newsFromParser, self::CHUNCK) as $newsDtoChunk) {
            $this->insertMany($newsDtoChunk);
        }
        Log::info('Parse ended');
    }

    protected function insertOneByOne($insert): void
    {
        /**
         * @var $item NewsDto
         */
        foreach ($insert as $item) {
            try {
                $this->newsRepository->insert($item);
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
