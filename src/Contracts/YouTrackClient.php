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
 * Interface YouTrackClient.
 *
 * @package Cog\YouTrack\Contracts
 */
interface YouTrackClient
{
    /**
     * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Log-in-to-YouTrack.html
     * @return void
     */
    public function authenticate();

    /**
     * Login with the passed credentials.
     * Stores cookie when login success.
     *
     * @return void
     */
    public function login();

    /**
     * @param string $uri
     * @param array $formData
     * @return array
     */
    public function get(string $uri, array $formData = []);
}
