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

namespace Cog\YouTrack\Responses;

use Cog\YouTrack\Contracts\ApiResponse as ApiResponseContract;
use Psr\Http\Message\ResponseInterface;

/**
 * Class YouTrackApiResponse.
 *
 * @package Cog\YouTrack\Responses
 */
class YouTrackApiResponse implements ApiResponseContract
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    /**
     * YouTrackApiResponse constructor.
     *
     * @param $response \Psr\Http\Message\ResponseInterface
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
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
     * Gets the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Transform response cookie headers to string.
     *
     * @return string
     */
    public function getCookie(): string
    {
        return $this->response->getHeaderLine('Set-Cookie');
    }

    /**
     * Gets the response Location header.
     *
     * @return string
     */
    public function getLocation(): string
    {
        return $this->response->getHeaderLine('Location');
    }
}
