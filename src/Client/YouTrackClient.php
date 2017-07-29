<?php

declare(strict_types=1);

/*
 * This file is part of YouTrack REST PHP.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\YouTrack\Rest\Client;

use Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException;
use Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer as AuthorizerContract;
use Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException;
use Cog\YouTrack\Rest\Client\Contracts\Client as RestClientContract;
use Cog\YouTrack\Rest\Client\Exceptions\ClientException;
use Cog\YouTrack\Rest\HttpClient\Contracts\HttpClient as HttpClientContract;
use Cog\YouTrack\Rest\HttpClient\Exceptions\HttpClientException;
use Cog\YouTrack\Rest\Response\Contracts\Response as ResponseContract;
use Cog\YouTrack\Rest\Response\YouTrackResponse;

/**
 * Class YouTrackRestClient.
 *
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/YouTrack-REST-API-Reference.html
 *
 * @package Cog\YouTrack\Rest\Client
 */
class YouTrackClient implements RestClientContract
{
    /**
     * HTTP Client.
     *
     * @var \Cog\YouTrack\Rest\HttpClient\Contracts\HttpClient
     */
    private $httpClient;

    /**
     * Authorization driver.
     *
     * @var \Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer
     */
    private $authorizer;

    /**
     * Endpoint path prefix.
     *
     * @todo make configurable
     * @todo test it
     * @todo choose good name
     * @var string
     */
    private $endpointPathPrefix = '/rest';

    /**
     * Request headers.
     *
     * @var array
     */
    private $headers = [];

    /**
     * YouTrackClient constructor.
     *
     * @param \Cog\YouTrack\Rest\HttpClient\Contracts\HttpClient $httpClient
     * @param \Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer $authorizer
     */
    public function __construct(HttpClientContract $httpClient, AuthorizerContract $authorizer)
    {
        $this->httpClient = $httpClient;
        $this->authorizer = $authorizer;
    }

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function request(string $method, string $uri, array $params = [], array $options = []) : ResponseContract
    {
        try {
            $response = $this->httpClient->request($method, $this->buildUri($uri), $this->buildOptions($params, $options));
        } catch (HttpClientException $e) {
            switch ($e->getCode()) {
                case 401:
                    throw new InvalidTokenException($e->getMessage(), $e->getCode());
                    break;
                case 403:
                    throw new AuthenticationException($e->getMessage(), $e->getCode());
                    break;
                default:
                    throw new ClientException($e->getMessage(), $e->getCode(), $e);
                    break;
            }
        }

        return new YouTrackResponse($response);
    }

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function get(string $uri, array $params = [], array $options = []): ResponseContract
    {
        return $this->request('GET', $uri, $params, $options);
    }

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function post(string $uri, array $params = [], array $options = []): ResponseContract
    {
        return $this->request('POST', $uri, $params, $options);
    }

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function put(string $uri, array $params = [], array $options = []): ResponseContract
    {
        return $this->request('PUT', $uri, $params, $options);
    }

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     * @throws \Cog\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function delete(string $uri, array $params = [], array $options = []): ResponseContract
    {
        return $this->request('DELETE', $uri, $params, $options);
    }

    /**
     * Write header value.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function withHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * Write header values.
     *
     * @param array $headers
     * @return void
     */
    public function withHeaders(array $headers): void
    {
        $this->headers = array_merge_recursive($this->headers, $headers);
    }

    /**
     * Write header value.
     *
     * @deprecated 3.2.0
     * @see withHeader
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function putHeader(string $key, string $value): void
    {
        $this->withHeader($key, $value);
    }

    /**
     * Build endpoint URI.
     *
     * @param string $uri
     * @return string
     */
    protected function buildUri(string $uri): string
    {
        return $this->endpointPathPrefix . '/' . ltrim($uri, '/');
    }

    /**
     * Build request options.
     *
     * @param array $params
     * @param array $options
     * @return array
     */
    protected function buildOptions(array $params = [], $options = []): array
    {
        $defaultOptions = [
            'form_params' => $params,
            'headers' => $this->buildHeaders(),
        ];

        if (isset($options['form_params'])) {
            $options['form_params'] = array_merge($params, $options['form_params']);
        }

        if (isset($options['headers'])) {
            $options['headers'] = array_merge($this->buildHeaders(), $options['headers']);
        }

        return array_merge($defaultOptions, $options);
    }

    /**
     * Build request headers.
     *
     * @return array
     */
    protected function buildHeaders(): array
    {
        $this->headers = [
            'User-Agent' => 'Cog-YouTrack-REST-PHP/' . self::VERSION,
            'Accept' => 'application/json',
        ];

        $this->authorizer->appendHeadersTo($this);

        return $this->headers;
    }
}
