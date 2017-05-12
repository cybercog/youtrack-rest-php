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

use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Exceptions\UserLoginError;
use Cog\YouTrack\Responses\YouTrackRestResponse;
use GuzzleHttp\ClientInterface as ClientContract;
use GuzzleHttp\Exception\ClientException;

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
     * @var string
     */
    private $cookie;

    /**
     * @param \GuzzleHttp\ClientInterface $http
     * @param array $options
     * @throws \Exception
     */
    public function __construct(ClientContract $http, array $options = [])
    {
        $this->http = $http;

        // TODO: Use strategy pattern here
        if (isset($options['token'])) {
            $this->authenticate($options['token']);
        } elseif (isset($options['username'], $options['password'])) {
            $this->login($options['username'], $options['password']);
        } else {
            throw new \Exception('YouTrack require authentication credentials.');
        }
    }

    /**
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Log-in-to-YouTrack.html
     * @return void
     */
    public function authenticate()
    {
        //
    }

    /**
     * Login with the passed credentials.
     * Stores cookie when login success.
     *
     * @param string $username
     * @param string $password
     * @return void
     *
     * @throws \Cog\YouTrack\Exceptions\UserLoginError
     */
    public function login($username, $password)
    {
        try {
            $response = $this->post('/rest/user/login', [
                'login' => $username,
                'password' => $password,
            ]);

            $this->cookie = $response->getCookie();
        } catch (ClientException $e) {
            // TODO: Make it more verbose
            throw new UserLoginError('Cannot login');
        }
    }

    /**
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Responses\YouTrackRestResponse
     */
    public function get(string $uri, array $formData = [])
    {
        $response = $this->http->request('get', $uri, $this->buildOptions($formData));

        return new YouTrackRestResponse($response);
    }

    /**
     * @param string $uri
     * @param array $formData
     * @return \Cog\YouTrack\Responses\YouTrackRestResponse
     */
    public function post(string $uri, array $formData = [])
    {
        $response = $this->http->request('post', $uri, $this->buildOptions($formData));

        return new YouTrackRestResponse($response);
    }

    /**
     * @param array $formData
     * @return array
     */
    protected function buildOptions(array $formData = [])
    {
        return [
            'form_params' => $formData,
            'headers' => [
                'Cookie' => $this->cookie,
                'User-Agent' => 'Cog-YouTrack-REST-PHP/1.0',
                'Accept' => 'application/json',
            ],
        ];
    }
}
