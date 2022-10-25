<?php

namespace App\Clients;

interface ClientInterface
{
    public function get(string $url);
}
