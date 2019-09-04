<?php

declare(strict_types=1);

/*
 * This file is part of PHP YouTrack REST.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\YouTrack\Rest\HttpClient;

use Cog\Contracts\YouTrack\Rest\HttpClient\HttpClient as HttpClientContract;
use Cog\Contracts\YouTrack\Rest\HttpClient\Exceptions\HttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

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
     * @throws \Cog\Contracts\YouTrack\Rest\HttpClient\Exceptions\HttpClientException
     */
    public function request(string $method, string $uri, array $options = []): ResponseInterface
    {
        try {
            return $this->httpClient->request($method, $uri, $this->buildOptions($options));
        } catch (BadResponseException $e) {
            throw new HttpClientException($e->getResponse()->getBody()->getContents(), $e->getCode(), $e);
        } catch (RequestException $e) {
            $rawResponse = $e->getResponse();
            if (!$rawResponse instanceof ResponseInterface) {
                throw new HttpClientException($e->getMessage(), $e->getCode(), $e);
            }
            throw new HttpClientException($rawResponse->getBody()->getContents(), $e->getCode(), $e);
        } catch (Throwable $e) {
            throw new HttpClientException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Build Http Client Request options.
     *
     * @param array $options
     * @return array
     */
    private function buildOptions(array $options): array
    {
        return $this->appendUserAgent($options);
    }

    /**
     * Append User-Agent header to Request options.
     *
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
