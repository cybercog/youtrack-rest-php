<?php

namespace Cog\YouTrack\Rest\HttpClient;

use Cog\YouTrack\Rest\HttpClient\Contracts\HttpClient as HttpClientContract;
use Cog\YouTrack\Rest\HttpClient\Exceptions\HttpClientException;
use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class GuzzleHttpClient.
 *
 * @package Cog\YouTrack\Rest\HttpClient
 */
class GuzzleHttpClient implements HttpClientContract
{
    /**
     * GuzzleHttp client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Create a new GuzzleHttpClient instance.
     *
     * @param \GuzzleHttp\Client|null $httpClient
     */
    public function __construct(Client $httpClient = null)
    {
        $this->httpClient = $httpClient;
    }

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
    public function request(string $method, string $uri, array $options = []): ResponseInterface
    {
        try {
            return $this->httpClient->request($method, $uri, $this->buildOptions($options));
        } catch (\Throwable $e) {
            throw new HttpClientException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get the Response Body.
     *
     * @param string|\Psr\Http\Message\ResponseInterface $response Response object
     *
     * @return string
     */
    private function getResponseBody($response)
    {
        //Response must be string
        $body = $response;

        if ($response instanceof ResponseInterface) {
            //Fetch the body
            $body = $response->getBody();
        }

        if ($body instanceof StreamInterface) {
            $body = $body->getContents();
        }

        return (string)$body;
    }

    /**
     * @param array $options
     * @return array
     */
    private function buildOptions(array $options): array
    {
        return $this->appendUserAgent($options);
    }

    /**
     * @param array $options
     * @return array
     */
    private function appendUserAgent(array $options): array
    {
        $defaultAgent = 'GuzzleHttp/' . Client::VERSION;
        if (extension_loaded('curl') && function_exists('curl_version')) {
            $defaultAgent .= ' curl/' . \curl_version()['version'];
        }
        $defaultAgent .= ' PHP/' . PHP_VERSION;

        if (!isset($options['headers']['User-Agent'])) {
            $options['headers']['User-Agent'] = $defaultAgent;
        }

        $options['headers']['User-Agent'] .= ' ' . $defaultAgent;

        return $options;
    }
}
