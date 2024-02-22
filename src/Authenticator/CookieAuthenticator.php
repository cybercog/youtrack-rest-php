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
     * Determine is trying to authenticate.
     */
    private bool $isAuthenticating = false;

    private string $cookie = '';

    public function __construct(
        private string $username,
        private string $password,
    ) {
    }

    /**
     * Authenticate client and returns cookie on success login.
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
     */
    public function token(): string
    {
        return $this->cookie;
    }
}
