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

namespace Cog\YouTrack\Rest\Response;

use Cog\YouTrack\Rest\Response\Contracts\Response as ResponseContract;
use Psr\Http\Message\ResponseInterface;

/**
 * Class YouTrackResponse.
 *
 * @package Cog\YouTrack\Rest\Response
 */
class YouTrackResponse implements ResponseContract
{
    /**
     * Original HTTP client response.
     *
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    /**
     * YouTrackResponse constructor.
     *
     * @param $response \Psr\Http\Message\ResponseInterface
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Returns original HTTP client response.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function httpResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Returns the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     *
     * @return int
     */
    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Retrieves a comma-separated string of the values for a single header.
     *
     * @param string $header
     * @return string
     */
    public function header(string $header): string
    {
        return $this->response->getHeaderLine($header);
    }

    /**
     * Transform response cookie headers to string.
     *
     * @return string
     */
    public function cookie(): string
    {
        return $this->header('Set-Cookie');
    }

    /**
     * Returns response location header.
     *
     * @return string
     */
    public function location(): string
    {
        return $this->header('Location');
    }

    /**
     * Returns body of the response.
     *
     * @return string
     */
    public function body(): string
    {
        return (string) $this->response->getBody();
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
     *
     * @param int $code
     * @return bool
     */
    public function isStatusCode(int $code): bool
    {
        return $this->response->getStatusCode() === $code;
    }

    /**
     * Determine if request has successful status code.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return in_array($this->statusCode(), array_merge(range(200, 208), [226]));
    }

    /**
     * Determine if request has redirect status code.
     *
     * @return bool
     */
    public function isRedirect(): bool
    {
        return in_array($this->statusCode(), range(300, 308));
    }
}
