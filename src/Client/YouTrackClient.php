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

namespace Cog\YouTrack\Rest\Client;

use Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException;
use Cog\Contracts\YouTrack\Rest\Authorizer\Authorizer as AuthorizerContract;
use Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken;
use Cog\Contracts\YouTrack\Rest\Client\Client as RestClientContract;
use Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException;
use Cog\Contracts\YouTrack\Rest\HttpClient\Exceptions\HttpClientException;
use Cog\Contracts\YouTrack\Rest\HttpClient\HttpClient as HttpClientContract;
use Cog\Contracts\YouTrack\Rest\Response\Response as ResponseContract;
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
     * @var \Cog\Contracts\YouTrack\Rest\HttpClient\HttpClient
     */
    private $httpClient;

    /**
     * Authorization driver.
     *
     * @var \Cog\Contracts\YouTrack\Rest\Authorizer\Authorizer
     */
    private $authorizer;

    /**
     * Endpoint path prefix.
     *
     * @todo test it
     * @todo choose good name
     * @var string
     */
    private $endpointPathPrefix;

    /**
     * Request headers.
     *
     * @var array
     */
    private $headers = [];

    /**
     * YouTrackClient constructor.
     *
     * @param \Cog\Contracts\YouTrack\Rest\HttpClient\HttpClient $httpClient
     * @param \Cog\Contracts\YouTrack\Rest\Authorizer\Authorizer $authorizer
     * @param string $prefix
     */
    public function __construct(HttpClientContract $httpClient, AuthorizerContract $authorizer, string $prefix = 'rest')
    {
        $this->httpClient = $httpClient;
        $this->authorizer = $authorizer;
        $this->endpointPathPrefix = $prefix;
    }

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $params
     * @param array $options
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
     */
    public function request(string $method, string $uri, array $params = [], array $options = []) : ResponseContract
    {
        try {
            $response = $this->httpClient->request($method, $this->buildUri($uri), $this->buildOptions($params, $options));
        } catch (HttpClientException $e) {
            switch ($e->getCode()) {
                case 401:
                    throw new InvalidAuthorizationToken($e->getMessage(), $e->getCode());
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
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
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
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
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
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
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
     * @return \Cog\Contracts\YouTrack\Rest\Response\Response
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken
     * @throws \Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException
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
    protected function buildOptions(array $params = [], array $options = []): array
    {
        $defaultOptions = [
            'form_params' => $params,
            'headers' => $this->buildHeaders(),
        ];

        if (isset($options['multipart'])) {
            unset($defaultOptions['form_params']);
            foreach ($params as $key => $value) {
                $options['multipart'][] = [
                    'name' => $key,
                    'data' => $value,
                ];
            }
        } elseif (isset($options['form_params'])) {
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
