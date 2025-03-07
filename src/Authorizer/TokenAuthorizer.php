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

use Cog\Contracts\YouTrack\Rest\Authorizer\Authorizer as AuthorizerInterface;
use Cog\Contracts\YouTrack\Rest\Client\Client as ClientInterface;

/**
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Log-in-to-YouTrack.html.
 */
class TokenAuthorizer implements
    AuthorizerInterface
{
    public function __construct(
        private readonly string $token,
    ) {
    }

    /**
     * Append authorization headers to REST client.
     */
    public function appendHeadersTo(
        ClientInterface $client,
    ): void {
        $client->withHeader('Authorization', "Bearer {$this->token}");
        $client->withHeader('Accept', 'application/json');
        $client->withHeader('Content-Type', 'application/json');
    }
}
