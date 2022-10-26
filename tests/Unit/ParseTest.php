<?php

namespace Tests\Unit;

use App\Clients\ClientInterface;
use App\Models\News;
use App\Parsers\ParserInterface;
use App\Parsers\SimpleXMLAdapter;
use App\Repositories\NewsRepository;
use App\Repositories\NewsRepositoryInterface;
use App\Services\ParserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class ParseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     * @throws \Exception
     */
    public function testParse(): void
    {
        News::query()->delete();
        $client = Mockery::mock(ClientInterface::class);
        $client->shouldReceive('get')
            ->andReturn(file_get_contents(__DIR__ . '/../Files/news.rss'));
        app()->instance(ClientInterface::class, $client);
        $rep = new NewsRepository(new News());
        $parser = new SimpleXMLAdapter();
        app()->instance(NewsRepositoryInterface::class, $rep);
        app()->instance(ParserInterface::class, $parser);
        /**
         * @var ParserService $service
         */
        $service = app(ParserService::class);
        $service->parse();
        $count = News::query()->count();
        self::assertEquals(30, $count);
    }
}
