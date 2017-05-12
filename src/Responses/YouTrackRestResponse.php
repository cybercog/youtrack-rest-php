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
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * @return string
     */
    public function getCookie()
    {
        return implode(', ', $this->response->getHeader('Set-Cookie'));
    }
}
