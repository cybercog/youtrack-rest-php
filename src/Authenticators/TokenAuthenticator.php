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

/**
 * Class TokenAuthenticator.
 *
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Log-in-to-YouTrack.html.
 *
 * @package Cog\YouTrack\Authenticators
 */
class TokenAuthenticator implements RestAuthenticatorContract
{
    /**
     * @var string
     */
    private $token;

    /**
     * TokenAuthenticator constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setCredentials($options);
    }

    /**
     * Get authentication headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Authorization' => "Bearer {$this->token}",
        ];
    }

    /**
     * Authenticate Http Client.
     *
     * @param \Cog\YouTrack\Contracts\YouTrackClient $connection
     * @return void
     */
    public function authenticate(YouTrackClientContract $connection): void
    {
        // Nothing to do
    }

    /**
     * Set authentication credentials.
     *
     * @param array $credentials
     * @return void
     */
    protected function setCredentials(array $credentials): void
    {
        $this->token = $credentials['token'];
    }
}
