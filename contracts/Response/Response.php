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

namespace Cog\Contracts\YouTrack\Rest\Response;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface Response
{
    /**
     * Returns original HTTP client response.
     */
    public function httpResponse(): PsrResponseInterface;

    /**
     * Returns the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     */
    public function statusCode(): int;

    /**
     * Retrieves a comma-separated string of the values for a single header.
     */
    public function header(
        string $header,
    ): string;

    /**
     * Transform response cookie headers to string.
     */
    public function cookie(): string;

    /**
     * Returns response location header.
     */
    public function location(): string;

    /**
     * Returns body of the response.
     */
    public function body(): string;

    /**
     * Transform response body to array.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Assert the status code of the response.
     */
    public function isStatusCode(
        int $code,
    ): bool;

    /**
     * Determine if response has successful status code.
     */
    public function isSuccess(): bool;

    /**
     * Determine if response has redirect status code.
     */
    public function isRedirect(): bool;

    /**
     * Determine if response has client error status code.
     */
    public function isClientError(): bool;

    /**
     * Determine if response has server error status code.
     */
    public function isServerError(): bool;
}
