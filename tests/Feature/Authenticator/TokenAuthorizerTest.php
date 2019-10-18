<?php

declare(strict_types=1);

/*
 * This file is part of PHP YouTrack REST.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\YouTrack\Rest\Tests\Feature\Authorizer;

use Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions\InvalidAuthorizationToken;
use Cog\YouTrack\Rest\Authorizer\TokenAuthorizer;
use Cog\YouTrack\Rest\Client\YouTrackClient;
use Cog\YouTrack\Rest\HttpClient\GuzzleHttpClient;
use Cog\YouTrack\Rest\Tests\FeatureTestCase;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

/**
 * Class TokenAuthorizerTest.
 *
 * @package Cog\YouTrack\Tests\Feature\Authorizer
 */
class TokenAuthorizerTest extends FeatureTestCase
{
    /** @test */
    public function it_throws_exception_on_failed_token_authorization(): void
    {
        $mock = new MockHandler([
            $this->createFakeResponse(401, 'unauthorized'),
        ]);
        $handler = HandlerStack::create($mock);
        $httpClient = new GuzzleHttpClient(new HttpClient(['handler' => $handler]));
        $authorizer = new TokenAuthorizer('invalid-token');
        $client = new YouTrackClient($httpClient, $authorizer);

        $this->expectException(InvalidAuthorizationToken::class);

        $client->get('/admin/project');
    }
}
