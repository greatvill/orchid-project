<?php

namespace App\Providers;

use App\Parsers\ParserInterface;
use App\Parsers\SimpleXMLAdapter;
use App\Repositories\NewsRepository;
use App\Repositories\NewsRepositoryInterface;
use App\Clients\Client;
use Illuminate\Support\ServiceProvider;
use App\Clients\ClientInterface;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        ClientInterface::class => Client::class,
        NewsRepositoryInterface::class => NewsRepository::class,
        ParserInterface::class => SimpleXMLAdapter::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
