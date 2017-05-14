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

use Cog\YouTrack\Contracts\ApiClient as ApiClientContract;

/**
 * Interface ApiAuthenticator.
 *
 * @package Cog\YouTrack\Contracts
 */
interface ApiAuthenticator
{
    /**
     * Authenticate API Client.
     *
     * @param \Cog\YouTrack\Contracts\ApiClient $client
     * @return void
     *
     * @throws \Cog\YouTrack\Exceptions\AuthenticationException
     */
    public function authenticate(ApiClientContract $client): void;

    /**
     * Authentication headers.
     *
     * @return array
     */
    public function getHeaders(): array;
}
