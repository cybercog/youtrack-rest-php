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
 * Interface ApiResponse.
 *
 * @package Cog\YouTrack\Contracts
 */
interface ApiResponse
{
    /**
     * Transform response body to array.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Gets the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Transform response cookie headers to string.
     *
     * @return string
     */
    public function getCookie(): string;

    /**
     * Gets the response Location header.
     *
     * @return string
     */
    public function getLocation(): string;
}
