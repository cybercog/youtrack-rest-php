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
use Cog\YouTrack\Rest\Response\Contracts\Response as ResponseContract;
use Cog\YouTrack\Rest\Response\YouTrackResponse;
use GuzzleHttp\ClientInterface as GuzzleClientContract;
use GuzzleHttp\Exception\ClientException;

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
     * Version of YouTrack REST PHP client.
     */
    const CLIENT_VERSION = '3.0.0';

    /**
     * HTTP Client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    private $http;

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
     * @param \GuzzleHttp\ClientInterface $http
     * @param \Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer $authorizer
     */
    public function __construct(GuzzleClientContract $http, AuthorizerContract $authorizer)
    {
        $this->http = $http;
        $this->authorizer = $authorizer;
    }

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\InvalidTokenException
     */
    public function request(string $method, string $uri, array $formData = []) : ResponseContract
    {
        try {
            $response = $this->http->request($method, $this->buildUri($uri), $this->buildOptions($formData));

            return new YouTrackResponse($response);
        } catch (ClientException $e) {
            switch ($e->getCode()) {
                case 401:
                    throw new InvalidTokenException($e->getMessage());
                    break;
                case 403:
                    throw new AuthenticationException($e->getMessage());
                    break;
                default:
                    throw $e;
                    break;
            }
        }
    }

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     */
    public function get(string $uri, array $formData = []): ResponseContract
    {
        return $this->request('GET', $uri, $formData);
    }

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     */
    public function post(string $uri, array $formData = []): ResponseContract
    {
        return $this->request('POST', $uri, $formData);
    }

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     */
    public function put(string $uri, array $formData = []): ResponseContract
    {
        return $this->request('PUT', $uri, $formData);
    }

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Rest\Response\Contracts\Response
     */
    public function delete(string $uri, array $formData = []): ResponseContract
    {
        return $this->request('DELETE', $uri, $formData);
    }

    /**
     * Write header value.
     *
     * @param string $key
     * @param string $value
     */
    public function putHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
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
     * @param array $formData
     * @return array
     */
    protected function buildOptions(array $formData = []): array
    {
        return [
            'form_params' => $formData,
            'headers' => $this->buildHeaders(),
        ];
    }

    /**
     * Build request headers.
     *
     * @param array $headers
     * @return array
     */
    protected function buildHeaders(array $headers = []): array
    {
        $this->headers = [
            'User-Agent' => 'Cog-YouTrack-REST-PHP/' . self::CLIENT_VERSION,
            'Accept' => 'application/json',
        ];

        $this->authorizer->appendHeadersTo($this);

        return array_merge($this->headers, $headers);
    }
}
