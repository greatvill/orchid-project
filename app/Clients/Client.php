<?php

namespace App\Clients;

use App\Models\Request;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class Client implements ClientInterface
{
    protected \GuzzleHttp\Client $baseClient;

    public function __construct()
    {
        $this->baseClient = new \GuzzleHttp\Client();
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $url, array $params = []): string
    {
        $response = $this->baseClient->get($url);

        $content = $response->getBody()->getContents();
        $data = [
            'body' => $content,
            'method' => 'get',
            'url' => $url,
            'code' => $response->getStatusCode(),
        ];
        $this->saveRequest($data);
        if ($response->getStatusCode() === 200) {
            Log::info('Response is success');
        } else {
            Log::info('Response is uncorrected');
        }

        return $content;
    }

    public function post(string $url, array $params = [])
    {
        // TODO: Implement post() method.
    }

    protected function saveRequest(array $data): Request
    {
        $requestModel = new Request();
        $requestModel->fill($data);
        $requestModel->save();
        return $requestModel;
    }
}
