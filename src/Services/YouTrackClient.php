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

use Cog\YouTrack\Authenticators\NullAuthenticator;
use Cog\YouTrack\Contracts\RestAuthenticator as RestAuthenticatorContract;
use Cog\YouTrack\Contracts\RestAuthenticator;
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Contracts\YouTrackRestResponse as YouTrackRestResponseContract;
use Cog\YouTrack\Responses\YouTrackRestResponse;
use GuzzleHttp\ClientInterface as ClientContract;

/**
 * Class YouTrackClient.
 *
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/YouTrack-REST-API-Reference.html *
 *
 * @package Cog\YouTrack\Services
 */
class YouTrackClient implements YouTrackClientContract
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $http;

    /**
     * @var \Cog\YouTrack\Contracts\RestAuthenticator
     */
    private $authenticator;


    /**
     * YouTrackClient constructor.
     *
     * @param \GuzzleHttp\ClientInterface $http
     * @param \Cog\YouTrack\Contracts\RestAuthenticator $authenticator
     */
    public function __construct(ClientContract $http, RestAuthenticatorContract $authenticator)
    {
        $this->http = $http;
        $this->setAuthenticator($authenticator);
        $this->authenticator->authenticate($this);
    }

    /**
     * Set authentication strategy.
     *
     * @param \Cog\YouTrack\Contracts\RestAuthenticator $authenticator
     * @return void
     */
    public function setAuthenticator(RestAuthenticatorContract $authenticator): void
    {
        $this->authenticator = $authenticator;
    }

    /**
     * Get authentication strategy.
     *
     * @return \Cog\YouTrack\Contracts\RestAuthenticator
     */
    public function getAuthenticator(): RestAuthenticatorContract
    {
        return $this->authenticator;
    }

    /**
     * Create client authenticator instance.
     *
     * @param string $authenticator
     * @return \Cog\YouTrack\Contracts\RestAuthenticator
     */
    public function createAuthenticator(string $authenticator): RestAuthenticatorContract
    {
        if (!$authenticator) {
            return new NullAuthenticator();
        }

        return new $authenticator($this);
    }

    /**
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function request(string $method, string $uri, array $formData = []) : YouTrackRestResponseContract
    {
        $response = $this->http->request($method, $uri, $this->buildOptions($formData));

        return new YouTrackRestResponse($response);
    }

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function get(string $uri, array $formData = []): YouTrackRestResponseContract
    {
        return $this->request('GET', $uri, $formData);
    }

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function post(string $uri, array $formData = []): YouTrackRestResponseContract
    {
        return $this->request('POST', $uri, $formData);
    }

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function put(string $uri, array $formData = []): YouTrackRestResponseContract
    {
        return $this->request('PUT', $uri, $formData);
    }

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Contracts\YouTrackRestResponse
     */
    public function delete(string $uri, array $formData = []): YouTrackRestResponseContract
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
            'User-Agent' => 'Cog-YouTrack-REST-PHP/1.0',
            'Accept' => 'application/json',
        ], $this->authenticator->getHeaders(), $headers);
    }
}
