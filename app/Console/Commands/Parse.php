<?php

namespace App\Console\Commands;

use App\Services\ParserService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class Parse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws GuzzleException
     */
    public function handle(ParserService $parserService)
    {
        $parserService->parse();
        return Command::SUCCESS;
    }
}
