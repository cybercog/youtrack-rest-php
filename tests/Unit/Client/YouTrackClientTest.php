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

namespace Cog\YouTrack\Rest\Tests\Unit\Client;

use Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator as AuthenticatorContract;
use Cog\YouTrack\Rest\Client\YouTrackClient;
use Cog\YouTrack\Rest\Tests\TestCase;
use GuzzleHttp\Client as HttpClient;

/**
 * Class YouTrackClientTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Client
 */
class YouTrackClientTest extends TestCase
{
    /** @test */
    public function it_can_get_authenticator()
    {
        $http = new HttpClient();
        /** @var \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator $authenticator */
        $authenticator = $this->createMock(AuthenticatorContract::class);
        $client = new YouTrackClient($http, $authenticator);

        $actualAuthenticator = $client->getAuthenticator();

        $this->assertInstanceOf(get_class($authenticator), $actualAuthenticator);
    }

    /** @test */
    public function it_can_set_authenticator()
    {
        $http = new HttpClient();
        /** @var \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator $authenticator */
        $authenticator = $this->createMock(AuthenticatorContract::class);
        /** @var \Cog\YouTrack\Rest\Authenticator\Contracts\Authenticator $newAuthenticator */
        $newAuthenticator = $this->createMock(AuthenticatorContract::class);
        $client = new YouTrackClient($http, $authenticator);

        $client->setAuthenticator($newAuthenticator);

        $this->assertAttributeSame($newAuthenticator, 'authenticator', $client);
    }
}
