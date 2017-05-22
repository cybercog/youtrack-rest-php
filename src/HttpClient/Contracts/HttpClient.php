<?php

namespace Cog\YouTrack\Rest\HttpClient\Contracts;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface HttpClient.
 *
 * @package Cog\YouTrack\Rest\HttpClient\Contracts
 */
interface HttpClient
{
    /**
     * Send request to the server and fetch the raw response.
     *
     * @param string $method Request Method
     * @param string $uri URI/Endpoint to send the request to
     * @param array $options Additional Options
     * @return \Psr\Http\Message\ResponseInterface Raw response from the server
     *
     * @throws \Cog\YouTrack\Rest\HttpClient\Exceptions\HttpClientException
     */
    public function request(string $method, string $uri, array $options = []): ResponseInterface;
}
