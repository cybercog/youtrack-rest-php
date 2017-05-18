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

use Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator as AuthenticatorContract;
use Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException;
use Cog\YouTrack\Rest\Authenticator\Exceptions\InvalidTokenException;
use Cog\YouTrack\Rest\Client\Contracts\Client as RestClientContract;
use Cog\YouTrack\Rest\Response\Contracts\Response as ResponseContract;
use Cog\YouTrack\Rest\Response\YouTrackResponse;
use GuzzleHttp\ClientInterface as GuzzleClientContract;
use GuzzleHttp\Exception\ClientException;

/**
 * Class YouTrackRestClient.
 *
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/YouTrack-REST-API-Reference.html *
 *
 * @package Cog\YouTrack\Rest\Client
 */
class YouTrackClient implements RestClientContract
{
    /**
     * Version of YouTrack REST PHP client.
     */
    const CLIENT_VERSION = '1.0.0';

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $http;

    /**
     * @var \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator
     */
    private $authenticator;

    /**
     * @todo make configurable
     * @todo test it
     * @todo choose good name
     * @var string
     */
    private $endpointPathPrefix = '/rest';

    /**
     * YouTrackClient constructor.
     *
     * @param \GuzzleHttp\ClientInterface $http
     * @param \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator $authenticator
     */
    public function __construct(GuzzleClientContract $http, AuthenticatorContract $authenticator)
    {
        $this->http = $http;
        $this->setAuthenticator($authenticator);
        $this->authenticator->authenticate($this);
    }

    /**
     * Set authentication strategy.
     *
     * @param \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator $authenticator
     * @return void
     */
    public function setAuthenticator(AuthenticatorContract $authenticator): void
    {
        $this->authenticator = $authenticator;
    }

    /**
     * Get authentication strategy.
     *
     * @return \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator
     */
    public function getAuthenticator(): AuthenticatorContract
    {
        return $this->authenticator;
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
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\InvalidTokenException
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
     * @param string $uri
     * @return string
     */
    protected function buildUri(string $uri): string
    {
        return $this->endpointPathPrefix . '/' . ltrim($uri, '/');
    }

    /**
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
     * @param array $headers
     * @return array
     */
    protected function buildHeaders(array $headers = []): array
    {
        return array_merge([
            'User-Agent' => 'Cog-YouTrack-REST-PHP/' . self::CLIENT_VERSION,
            'Accept' => 'application/json',
        ], $this->authenticator->getHeaders(), $headers);
    }
}
