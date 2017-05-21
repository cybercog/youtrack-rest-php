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

namespace Cog\YouTrack\Rest\Response\Contracts;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface Response.
 *
 * @package Cog\YouTrack\Rest\Response\Contracts
 */
interface Response
{
    /**
     * Returns original HTTP client response.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function httpResponse(): ResponseInterface;

    /**
     * Returns the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     *
     * @return int
     */
    public function statusCode(): int;

    /**
     * Transform response cookie headers to string.
     *
     * @return string
     */
    public function cookie(): string;

    /**
     * Returns the response Location header.
     *
     * @return string
     */
    public function location(): string;

    /**
     * Transform response body to array.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Assert the status code of the response.
     *
     * @param int $code
     * @return bool
     */
    public function isStatusCode(int $code): bool;
}
