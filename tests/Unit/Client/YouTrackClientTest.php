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

use Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer as AuthorizerContract;
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
    public function it_can_get_authorizer()
    {
        $http = new HttpClient();
        /** @var \Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer $authorizer */
        $authorizer = $this->createMock(AuthorizerContract::class);
        $client = new YouTrackClient($http, $authorizer);

        $actualAuthorizer = $client->getAuthorizer();

        $this->assertInstanceOf(get_class($authorizer), $actualAuthorizer);
    }

    /** @test */
    public function it_can_set_authorizer()
    {
        $http = new HttpClient();
        /** @var \Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer $authorizer */
        $authorizer = $this->createMock(AuthorizerContract::class);
        /** @var \Cog\YouTrack\Rest\Authorizer\Contracts\Authorizer $newAuthorizer */
        $newAuthorizer = $this->createMock(AuthorizerContract::class);
        $client = new YouTrackClient($http, $authorizer);

        $client->setAuthorizer($newAuthorizer);

        $this->assertAttributeSame($newAuthorizer, 'authorizer', $client);
    }
}
