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
use Cog\Contracts\YouTrack\Rest\Authorizer\Authorizer as AuthorizerInterface;
use Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken;
use Cog\Contracts\YouTrack\Rest\Client\Client as RestClientInterface;
use Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException;
use Cog\Contracts\YouTrack\Rest\HttpClient\Exceptions\HttpClientException;
use Cog\Contracts\YouTrack\Rest\HttpClient\HttpClient as HttpClientInterface;
use Cog\Contracts\YouTrack\Rest\Response\Response as ResponseInterface;
use Cog\YouTrack\Rest\Response\YouTrackResponse;

/**
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/YouTrack-REST-API-Reference.html
 */
class YouTrackClient implements
    RestClientInterface
{
    /**
     * Endpoint path prefix.
     *
     * @todo test it
     */
    private string $endpointPathPrefix;

    /**
     * Request headers.
     *
     * @var array<string, string>
     */
    private array $headers = [];

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly AuthorizerInterface $authorizer,
        string | null $endpointPathPrefix = null,
    ) {
        $this->endpointPathPrefix = $endpointPathPrefix !== null
            ? $endpointPathPrefix
            : 'api';
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
    public function request(
        string $method,
        string $uri,
        array $params = [],
        array $options = [],
    ): ResponseInterface {
        try {
            $response = $this->httpClient->request(
                $method,
                $this->buildUri($uri),
                $this->buildOptions($params, $options),
            );
        } catch (HttpClientException $e) {
            switch ($e->getCode()) {
                case 401:
                    throw new InvalidAuthorizationToken($e->getMessage(), $e->getCode());
                case 403:
                    throw new AuthenticationException($e->getMessage(), $e->getCode());
                default:
                    throw new ClientException($e->getMessage(), $e->getCode(), $e);
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
    public function get(
        string $uri,
        array $params = [],
        array $options = [],
    ): ResponseInterface {
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
    public function post(
        string $uri,
        array $params = [],
        array $options = [],
    ): ResponseInterface {
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
    public function put(
        string $uri,
        array $params = [],
        array $options = [],
    ): ResponseInterface {
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
    public function delete(
        string $uri,
        array $params = [],
        array $options = [],
    ): ResponseInterface {
        return $this->request('DELETE', $uri, $params, $options);
    }

    /**
     * Write header value.
     */
    public function withHeader(
        string $key,
        string $value,
    ): void {
        $this->headers[$key] = $value;
    }

    /**
     * Write header values.
     *
     * @param array $headers
     * @return void
     */
    public function withHeaders(
        array $headers,
    ): void {
        $this->headers = array_merge_recursive($this->headers, $headers);
    }

    /**
     * Build endpoint URI.
     */
    protected function buildUri(
        string $uri,
    ): string {
        return $this->endpointPathPrefix . '/' . ltrim($uri, '/');
    }

    /**
     * Build request options.
     *
     * @param array $params
     * @param array $options
     * @return array
     */
    protected function buildOptions(
        array $params = [],
        array $options = [],
    ): array {
        if ($params) {
            if (isset($options['multipart'])) {
                foreach ($params as $key => $value) {
                    $options['multipart'][] = [
                        'name' => $key,
                        'contents' => $value,
                    ];
                }
            } else {
                $options['form_params'] = array_merge($params, $options['form_params'] ?? []);
            }
        }

        $options['headers'] = array_merge($this->buildHeaders(), $options['headers'] ?? []);

        return $options;
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
