<?php

namespace App\Clients;

use App\Models\Request;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class Client implements ClientInterface
{

    /**
     * @throws GuzzleException
     */
    public function get(string $url)
    {
        $response = (new \GuzzleHttp\Client())->get($url);
        $requestModel = new Request();
        $content = $response->getBody()->getContents();
        $data = [
            'body' => $content,
            'method' => 'get',
            'url' => $url,
            'code' => $response->getStatusCode(),
        ];
        $requestModel->fill($data);
        $requestModel->save();
        if ($response->getStatusCode() !== 200) {
            Log::info('Response in success');
        } else {
            Log::info('Response in uncorrected');
        }

        return $response->getBody()->getContents();
    }
}
