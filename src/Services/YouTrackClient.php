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

namespace Cog\YouTrack\Services;

use Cog\YouTrack\Contracts\ApiAuthenticator as ApiAuthenticatorContract;
use Cog\YouTrack\Contracts\ApiClient as ApiClientContract;
use Cog\YouTrack\Contracts\ApiResponse as ApiResponseContract;
use Cog\YouTrack\Responses\YouTrackApiResponse;
use GuzzleHttp\ClientInterface as ClientContract;

/**
 * Class YouTrackClient.
 *
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/YouTrack-REST-API-Reference.html *
 *
 * @package Cog\YouTrack\Services
 */
class YouTrackClient implements ApiClientContract
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
     * @var \Cog\YouTrack\Contracts\ApiAuthenticator
     */
    private $authenticator;

    /**
     * YouTrackClient constructor.
     *
     * @param \GuzzleHttp\ClientInterface $http
     * @param \Cog\YouTrack\Contracts\ApiAuthenticator $authenticator
     */
    public function __construct(ClientContract $http, ApiAuthenticatorContract $authenticator)
    {
        $this->http = $http;
        $this->setAuthenticator($authenticator);
        $this->authenticator->authenticate($this);
    }

    /**
     * Set authentication strategy.
     *
     * @param \Cog\YouTrack\Contracts\ApiAuthenticator $authenticator
     * @return void
     */
    public function setAuthenticator(ApiAuthenticatorContract $authenticator): void
    {
        $this->authenticator = $authenticator;
    }

    /**
     * Get authentication strategy.
     *
     * @return \Cog\YouTrack\Contracts\ApiAuthenticator
     */
    public function getAuthenticator(): ApiAuthenticatorContract
    {
        return $this->authenticator;
    }

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function request(string $method, string $uri, array $formData = []) : ApiResponseContract
    {
        $response = $this->http->request($method, $uri, $this->buildOptions($formData));

        return new YouTrackApiResponse($response);
    }

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function get(string $uri, array $formData = []): ApiResponseContract
    {
        return $this->request('GET', $uri, $formData);
    }

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function post(string $uri, array $formData = []): ApiResponseContract
    {
        return $this->request('POST', $uri, $formData);
    }

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function put(string $uri, array $formData = []): ApiResponseContract
    {
        return $this->request('PUT', $uri, $formData);
    }

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\ApiResponse
     */
    public function delete(string $uri, array $formData = []): ApiResponseContract
    {
        return $this->request('DELETE', $uri, $formData);
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
