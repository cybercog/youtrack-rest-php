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

namespace Cog\YouTrack\Rest\Response;

use Cog\Contracts\YouTrack\Rest\Response\Response as ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class YouTrackResponse implements
    ResponseInterface
{
    public function __construct(
        private readonly PsrResponseInterface $response,
    ) {}

    /**
     * Returns original HTTP client response.
     */
    public function httpResponse(): PsrResponseInterface
    {
        return $this->response;
    }

    /**
     * Returns the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     */
    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Retrieves a comma-separated string of the values for a single header.
     */
    public function header(
        string $header,
    ): string {
        return $this->response->getHeaderLine($header);
    }

    /**
     * Transform response cookie headers to string.
     */
    public function cookie(): string
    {
        return $this->header('Set-Cookie');
    }

    /**
     * Returns response location header.
     */
    public function location(): string
    {
        return $this->header('Location');
    }

    /**
     * Returns body of the response.
     */
    public function body(): string
    {
        return (string)$this->response->getBody();
    }

    /**
     * Transform response body to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * Assert the status code of the response.
     */
    public function isStatusCode(
        int $code,
    ): bool {
        return $this->response->getStatusCode() === $code;
    }

    /**
     * Determine if response has successful status code.
     */
    public function isSuccess(): bool
    {
        return $this->statusCode() >= 200 && $this->statusCode() < 300;
    }

    /**
     * Determine if response has redirect status code.
     */
    public function isRedirect(): bool
    {
        return $this->statusCode() >= 300 && $this->statusCode() < 400;
    }

    /**
     * Determine if response has client error status code.
     */
    public function isClientError(): bool
    {
        return $this->statusCode() >= 400 && $this->statusCode() < 500;
    }

    /**
     * Determine if response has server error status code.
     */
    public function isServerError(): bool
    {
        return $this->statusCode() >= 500;
    }
}
