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
 * Class TokenAuthorizer.
 *
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Log-in-to-YouTrack.html.
 *
 * @package Cog\YouTrack\Rest\Authorizer
 */
class TokenAuthorizer implements AuthorizerContract
{
    /**
     * @var string
     */
    private $token;

    /**
     * TokenAuthorizer constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setToken($options);
    }

    /**
     * Returns authorization headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Authorization' => "Bearer {$this->token}",
        ];
    }

    /**
     * Authenticate API Client.
     *
     * @param \Cog\YouTrack\Rest\Client\Contracts\Client $client
     * @return void
     */
    public function authenticate(ClientContract $client): void
    {
        // Nothing to do
    }

    /**
     * Set authorization token.
     *
     * @param array $credentials
     * @return void
     */
    protected function setToken(array $credentials): void
    {
        $this->token = $credentials['token'];
    }
}
