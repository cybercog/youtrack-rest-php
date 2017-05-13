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

use Cog\YouTrack\Contracts\RestAuthenticator as RestAuthenticatorContract;
use Cog\YouTrack\Contracts\RestAuthenticator;
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Responses\YouTrackRestResponse;
use GuzzleHttp\ClientInterface as ClientContract;

/**
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/YouTrack-REST-API-Reference.html
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
     * @param \GuzzleHttp\ClientInterface $http
     * @param array $options
     * @throws \Exception
     */
    public function __construct(ClientContract $http, array $options = [])
    {
        $this->http = $http;

        $this->setAuthenticator(
            $this->createAuthenticator($options)
        );

        $this->authenticator->authenticate($options);
    }

    /**
     * Create client authenticator instance.
     *
     * @param array $options
     * @return \Cog\YouTrack\Contracts\RestAuthenticator
     * @throws \Exception
     */
    public function createAuthenticator(array $options): RestAuthenticatorContract
    {
        if (!isset($options['class'])) {
            throw new \Exception('Set YouTrack authenticator class.');
        }

        return new $options['class']($this);
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
     * Create and send an HTTP request.
     *
     * @param string $method
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Responses\YouTrackRestResponse
     */
    public function request(string $method, string $uri, array $formData = []) : YouTrackRestResponse
    {
        $response = $this->http->request($method, $uri, $this->buildOptions($formData));

        return new YouTrackRestResponse($response);
    }

    /**
     * Create and send an GET HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Responses\YouTrackRestResponse
     */
    public function get(string $uri, array $formData = []): YouTrackRestResponse
    {
        return $this->request('get', $uri, $formData);
    }

    /**
     * Create and send an POST HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Responses\YouTrackRestResponse
     */
    public function post(string $uri, array $formData = []): YouTrackRestResponse
    {
        return $this->request('post', $uri, $formData);
    }

    /**
     * Create and send an PUT HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Responses\YouTrackRestResponse
     */
    public function put(string $uri, array $formData = []): YouTrackRestResponse
    {
        return $this->request('put', $uri, $formData);
    }

    /**
     * Create and send an DELETE HTTP request.
     *
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Responses\YouTrackRestResponse
     */
    public function delete(string $uri, array $formData = []): YouTrackRestResponse
    {
        return $this->request('delete', $uri, $formData);
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
