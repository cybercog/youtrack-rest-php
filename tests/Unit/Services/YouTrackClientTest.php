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

namespace Cog\YouTrack\Tests\Unit\Services;

use Cog\YouTrack\Contracts\RestAuthenticator as RestAuthenticatorContract;
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Exceptions\AuthenticationException;
use Cog\YouTrack\Services\YouTrackClient;
use Cog\YouTrack\Tests\TestCase;

/**
 * Class YouTrackClientTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Services
 */
class YouTrackClientTest extends TestCase
{
    /** @test */
    public function it_can_get_authenticator()
    {
        $client = $this->app->make(YouTrackClientContract::class);
        $authenticator = $this->createMock(RestAuthenticatorContract::class);
        $this->setPrivateProperty($client, 'authenticator', $authenticator);

        $actualAuthenticator = $client->getAuthenticator();

        $this->assertInstanceOf(get_class($authenticator), $actualAuthenticator);
    }

    /** @test */
    public function it_can_set_authenticator()
    {
        $client = $this->app->make(YouTrackClientContract::class);
        $authenticator = $this->createMock(RestAuthenticatorContract::class);

        $client->setAuthenticator($authenticator);

        $this->assertAttributeInstanceOf(get_class($authenticator), 'authenticator', $client);
    }

    /** @test */
    public function it_can_instantiate_youtrack_client_from_container_with_token_authenticator()
    {
        $this->app['config']->set('youtrack.authenticator', 'token');

        $client = $this->app->make(YouTrackClientContract::class);

        $this->assertInstanceOf(YouTrackClient::class, $client);
    }

    /** @test */
    public function it_can_instantiate_youtrack_client_from_container_with_cookie_authenticator()
    {
        $this->app['config']->set('youtrack.authenticator', 'cookie');

        $client = $this->app->make(YouTrackClientContract::class);

        $this->assertInstanceOf(YouTrackClient::class, $client);
    }

    /** @test */
    public function it_throws_exception_on_failed_cookie_authentication()
    {
        $this->expectException(AuthenticationException::class);
        $this->app['config']->set('youtrack.authenticator', 'cookie');
        $this->app['config']->set('youtrack.authenticators.cookie.password', 'wrong-password');

        $this->app->make(YouTrackClientContract::class);
    }
}
