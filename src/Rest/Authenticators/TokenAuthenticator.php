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

namespace Cog\YouTrack\Rest\Authenticators;

use Cog\YouTrack\Contracts\ApiAuthenticator as ApiAuthenticatorContract;
use Cog\YouTrack\Contracts\ApiClient as ApiClientContract;

/**
 * Class TokenAuthenticator.
 *
 * @see https://www.jetbrains.com/help/youtrack/standalone/2017.2/Log-in-to-YouTrack.html.
 *
 * @package Cog\YouTrack\Rest\Authenticators
 */
class TokenAuthenticator implements ApiAuthenticatorContract
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
     * Authenticate API Client.
     *
     * @param \Cog\YouTrack\Contracts\ApiClient $client
     * @return void
     */
    public function authenticate(ApiClientContract $client): void
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
