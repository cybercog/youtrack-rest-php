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

namespace Cog\YouTrack\Rest\Authorizer;

use Cog\Contracts\YouTrack\Rest\Authorizer\Authorizer as AuthorizerContract;
use Cog\Contracts\YouTrack\Rest\Client\Client as ClientContract;

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
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Append authorization headers to REST client.
     *
     * @param \Cog\Contracts\YouTrack\Rest\Client\Client $client
     * @return void
     */
    public function appendHeadersTo(ClientContract $client): void
    {
        $client->withHeader('Authorization', "Bearer {$this->token}");
    }
}
