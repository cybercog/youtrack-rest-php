<?php

declare(strict_types=1);

/*
 * This file is part of PHP YouTrack REST.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\YouTrack\Rest\Authenticator;

use Cog\Contracts\YouTrack\Rest\Authenticator\Authenticator as AuthenticatorInterface;
use Cog\Contracts\YouTrack\Rest\Client\Client as ClientInterface;

class CookieAuthenticator implements
    AuthenticatorInterface
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
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     */
    public function authenticate(ClientInterface $client): void
    {
        if ($this->cookie !== '' || $this->isAuthenticating) {
            return;
        }

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

    /**
     * Retrieve authentication token.
     *
     * @return string
     */
    public function token(): string
    {
        return $this->cookie;
    }
}
