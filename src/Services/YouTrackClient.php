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
     * @var array
     */
    private $options;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $cookie;

    /**
     * @param \GuzzleHttp\ClientInterface $http
     * @param array $options
     */
    public function __construct(ClientContract $http, array $options = [])
    {
        $this->http = $http;
        $this->options = $options;
        // TODO: Strategy: If token set - call `authenticate()`
        // TODO: Strategy: If user+password set - call `login()`
        // TODO: Strategy: If none set - throw exception
        $this->username = $options['username'];
        $this->password = $options['password'];
        $this->login();
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
     * @return void
     *
     * @throws \Cog\YouTrack\Exceptions\UserLoginError
     */
    public function login()
    {
        try {
            $response = $this->http->request('post', '/rest/user/login', $this->buildOptions([
                'login' => $this->username,
                'password' => $this->password,
            ]));

            // TODO: Use it in all future requests
            $this->cookie = implode(', ', $response->getHeader('Set-Cookie'));
        } catch (ClientException $e) {
            throw new UserLoginError('Cannot login');
        }
    }

    /**
     * @param string $uri
     * @param array $formData
     * @return array
     */
    public function get(string $uri, array $formData = [])
    {
        $response = $this->http->request('get', $uri, $this->buildOptions($formData));

        // TODO: Return YouTrackResponse object with ability to choose how to transform it

        return json_decode($response->getBody()->getContents(), true);
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
