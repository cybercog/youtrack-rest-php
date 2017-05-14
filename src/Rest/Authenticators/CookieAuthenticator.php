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

namespace Cog\YouTrack\Rest\Authenticators;

use Cog\YouTrack\Contracts\ApiAuthenticator as ApiAuthenticatorContract;
use Cog\YouTrack\Contracts\ApiClient as ApiClientContract;
use Cog\YouTrack\Exceptions\AuthenticationException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class CookieAuthenticator.
 *
 * @package Cog\YouTrack\Rest\Authenticators
 */
class CookieAuthenticator implements ApiAuthenticatorContract
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
     * @param \Cog\YouTrack\Contracts\ApiClient $client
     * @return void
     *
     * @throws \Cog\YouTrack\Exceptions\AuthenticationException
     */
    public function authenticate(ApiClientContract $client): void
    {
        try {
            $response = $client->post('/rest/user/login', [
                'login' => $this->username,
                'password' => $this->password,
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
