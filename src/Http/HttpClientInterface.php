<?php

namespace RizwanNasir\MtnMomo\Http;

use RizwanNasir\MtnMomo\Exceptions\MtnMomoException;

interface HttpClientInterface
{
    /**
     * @param string $method  The HTTP method being used
     * @param string $absoluteUrl  The URL being requested, including domain and protocol
     * @param array $params  KV pairs for parameters. Can be nested for arrays and hashes
     * @param array $headers Headers to be used in the request (full strings, not KV pairs)
     *
     * @return ApiResponse An array whose first element is raw request body, second
     *    element is HTTP status code and third array of HTTP headers.
     *@throws MtnMomoException
     */
    public function request(string $method, string $absoluteUrl, array $params = [], array $headers = []): ApiResponse;
}
