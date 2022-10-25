<?php

namespace App\Clients;

interface ClientInterface
{
    public function get(string $url, array $params = []): string;

    public function post(string $url, array $params = []);
}
