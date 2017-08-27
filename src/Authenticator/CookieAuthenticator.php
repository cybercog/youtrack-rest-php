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

use Cog\Contracts\YouTrack\Rest\Authenticator\Authenticator as AuthenticatorContract;
use Cog\Contracts\YouTrack\Rest\Client\Client as ClientContract;

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
    private $username = '';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var string
     */
    private $cookie = '';

    /**
     * Determine is trying to authenticate.
     *
     * @var bool
     */
    private $isAuthenticating = false;

    /**
     * CookieAuthenticator constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Authenticate client and returns cookie on success login.
     *
     * @param \Cog\Contracts\YouTrack\Rest\Client\Client $client
     * @return void
     *
     * @throws \Cog\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     */
    public function authenticate(ClientContract $client): void
    {
        if ($this->cookie === '' && !$this->isAuthenticating) {
            $this->isAuthenticating = true;
            $response = $client->request('POST', '/user/login', [
                'login' => $this->username,
                'password' => $this->password,
            ]);
            $this->isAuthenticating = false;

            if ($response->isStatusCode(200)) {
                $this->cookie = $response->cookie();
            }
        }

        $client->withHeader('Cookie', $this->cookie);
    }
}
