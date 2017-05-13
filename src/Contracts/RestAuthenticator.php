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
     * @param array $credentials
     * @return void
     */
    public function authenticate(array $credentials): void;

    /**
     * Authentication headers.
     *
     * @return array
     */
    public function getHeaders(): array;
}
