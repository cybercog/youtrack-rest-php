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

namespace Cog\Contracts\YouTrack\Rest\Authenticator;

use Cog\Contracts\YouTrack\Rest\Client\Client as ClientInterface;

interface Authenticator
{
    /**
     * Authenticate API Client.
     *
     * @param \Cog\Contracts\YouTrack\Rest\Client\Client $client
     * @return void
     *
     * @throws \Cog\Contracts\YouTrack\Rest\Authenticator\Exceptions\AuthenticationException
     */
    public function authenticate(ClientInterface $client): void;

    /**
     * Retrieve authentication token.
     *
     * @return string
     */
    public function token(): string;
}
