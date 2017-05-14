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

namespace Cog\YouTrack\Authenticators;

use Cog\YouTrack\Contracts\RestAuthenticator as RestAuthenticatorContract;
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Exceptions\AuthenticationException;

/**
 * Class NullAuthenticator.
 *
 * @package Cog\YouTrack\Authenticators
 */
class NullAuthenticator implements RestAuthenticatorContract
{
    /**
     * Authentication headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return [];
    }

    /**
     * Authenticate Http Client.
     *
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Log-in-to-YouTrack.html.
     *
     * @param \Cog\YouTrack\Contracts\YouTrackClient $connection
     * @return void
     *
     * @throws \Cog\YouTrack\Exceptions\AuthenticationException
     */
    public function authenticate(YouTrackClientContract $connection): void
    {
        throw new AuthenticationException('Set YouTrack authenticator class.');
    }
}
