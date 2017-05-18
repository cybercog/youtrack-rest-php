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

namespace Cog\YouTrack\Rest\Authenticator;

use Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator as AuthenticatorContract;
use Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException;
use Cog\YouTrack\Rest\Client\Contracts\Client as ClientContract;
use GuzzleHttp\Exception\ClientException;

/**
 * Class CookieAuthenticator.
 *
 * @package Cog\YouTrack\Rest\Authenticator
 */
class CookieAuthenticator implements AuthenticatorContract
{
    /**
     * @var string
     */
    private $cookie;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * CookieAuthenticator constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setCredentials($options);
    }

    /**
     * Authenticate API Client.
     * Stores cookie on success login.
     *
     * @param \Cog\YouTrack\Rest\Client\Contracts\Client $client
     * @return void
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     */
    public function authenticate(ClientContract $client): void
    {
        $response = $client->post('/user/login', [
            'login' => $this->username,
            'password' => $this->password,
        ]);

        $this->cookie = $response->getCookie();
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

    /**
     * Set authentication credentials.
     *
     * @param array $credentials
     * @return void
     */
    protected function setCredentials(array $credentials): void
    {
        $this->username = $credentials['username'];
        $this->password = $credentials['password'];
    }
}
