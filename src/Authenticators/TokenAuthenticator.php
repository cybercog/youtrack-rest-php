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

namespace Cog\YouTrack\Authenticators;

use Cog\YouTrack\Contracts\RestAuthenticator as RestAuthenticatorContract;
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;

class TokenAuthenticator implements RestAuthenticatorContract
{
    /**
     * @var \Cog\YouTrack\Contracts\YouTrackClient
     */
    private $http;

    /**
     * @var string
     */
    private $token;

    /**
     * @param \Cog\YouTrack\Contracts\YouTrackClient $http
     * @param array $options
     * @throws \Exception
     */
    public function __construct(YouTrackClientContract $http, array $options = [])
    {
        $this->http = $http;
    }

    /**
     * Authenticate Http Client.
     * https://www.jetbrains.com/help/youtrack/standalone/2017.2/Log-in-to-YouTrack.html.
     *
     * @param array $credentials
     * @return void
     */
    public function authenticate(array $credentials): void
    {
        $this->token = $credentials['token'];
    }

    public function getHeaders(): array
    {
        return [
            'Authorization' => "Bearer {$this->token}",
        ];
    }
}
