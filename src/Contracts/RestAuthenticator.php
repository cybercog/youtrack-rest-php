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

namespace Cog\YouTrack\Contracts;

use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;

/**
 * Interface RestAuthenticator.
 *
 * @package Cog\YouTrack\Contracts
 */
interface RestAuthenticator
{
    /**
     * Authenticate Http Client.
     *
     * @param \Cog\YouTrack\Contracts\YouTrackClient $connection
     * @return void
     *
     * @throws \Cog\YouTrack\Exceptions\AuthenticationException
     */
    public function authenticate(YouTrackClientContract $connection): void;

    /**
     * Authentication headers.
     *
     * @return array
     */
    public function getHeaders(): array;
}
