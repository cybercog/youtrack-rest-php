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

namespace Cog\YouTrack\Rest\Authorizer;

use Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer as AuthorizerContract;
use Cog\YouTrack\Rest\Client\Contracts\Client as ClientContract;

/**
 * Class CookieAuthorizer.
 *
 * @package Cog\YouTrack\Rest\Authorizer
 */
class CookieAuthorizer implements AuthorizerContract
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
     * CookieAuthorizer constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setCredentials($options);
    }

    /**
     * Returns authorization headers.
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
     * Authenticate API Client.
     * Stores cookie on success login.
     *
     * @param \Cog\YouTrack\Rest\Client\Contracts\Client $client
     * @return void
     *
     * @throws \Cog\YouTrack\Rest\Authorizer\Exceptions\AuthenticationException
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
     * Set authorization credentials.
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
