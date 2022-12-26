<?php

namespace RizwanNasir\MtnMomo\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use RizwanNasir\MtnMomo\Exceptions\MtnMomoException;

class GuzzleClient implements HttpClientInterface
{


    public function __construct(private ?ClientInterface $client = null)
    {
        // $this->client = $client ?? new Client();  
        $this->client = $client ?? new Client(['http_errors' => false]);
    }

    /**
     * Make an http request
     * @throws MtnMomoException
     */
    public function request(
        string $method,
        string $absoluteUrl,
        array  $params = [],
        array  $headers = []
    ): ApiResponse
    {
        try {
            $response = $this->client->request($method, $absoluteUrl, [
                'headers' => $headers,
                'json' => $params
            ]);
            return new ApiResponse(
                $response->getStatusCode(),
                (string)$response->getBody(),
                $response->getHeaders(),
                [
                    'headers' => $headers,
                    'form_data' => $params,
                    'url' => $absoluteUrl,
                    'method' => strtoupper($method)
                ]
            );
        } catch (\Exception $exception) {
            throw new MtnMomoException("HTTP request failed: {$absoluteUrl} " . $exception->getMessage(), null, $exception);
        } catch (GuzzleException $e) {
            Log::error($e);
        }

        // Casting the body (stream) to a string performs a rewind, ensuring we return the entire response.
        // See https://stackoverflow.com/a/30549372/86696
        return new ApiResponse(500, 'server error');
    }

}
