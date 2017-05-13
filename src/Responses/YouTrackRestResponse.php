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

use Psr\Http\Message\ResponseInterface;

/**
 * Class YouTrackRestResponse.
 *
 * @package Cog\YouTrack\Responses
 */
class YouTrackRestResponse
{
    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;

    /**
     * YouTrackRestResponse constructor.
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
     * Transform response cookie headers to string.
     *
     * @return string
     */
    public function getCookie(): string
    {
        return implode(', ', $this->response->getHeader('Set-Cookie'));
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
}
