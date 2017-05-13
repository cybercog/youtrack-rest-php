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

namespace Cog\YouTrack\Authenticators;

use Cog\YouTrack\Contracts\RestAuthenticator as RestAuthenticatorContract;
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Exceptions\AuthenticationException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class CookieAuthenticator.
 *
 * @package Cog\YouTrack\Authenticators
 */
class CookieAuthenticator implements RestAuthenticatorContract
{
    /**
     * @var \Cog\YouTrack\Contracts\YouTrackClient
     */
    private $http;

    /**
     * @var string
     */
    private $cookie;

    /**
     * @param \Cog\YouTrack\Contracts\YouTrackClient $http
     * @param array $options
     * @throws \Exception
     */
    public function __construct(YouTrackClientContract $http, array $options = [])
    {
        $this->http = $http;
    }

    /**
     * Authenticate Http Client.
     * Stores cookie on success login.
     *
     * @param array $credentials
     * @return void
     *
     * @throws \Cog\YouTrack\Exceptions\AuthenticationException
     */
    public function authenticate(array $credentials): void
    {
        try {
            $response = $this->http->post('/rest/user/login', [
                'login' => $credentials['username'],
                'password' => $credentials['password'],
            ]);

            $this->cookie = $response->getCookie();
        } catch (ClientException $e) {
            // TODO: Make it more verbose
            throw new AuthenticationException('Cannot login');
        }
    }

    /**
     * Authentication headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Cookie' => $this->cookie,
        ];
    }
}
