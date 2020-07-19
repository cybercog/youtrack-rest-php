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

namespace Cog\YouTrack\Rest\Tests\Feature;

use Cog\YouTrack\Rest\Authorizer\TokenAuthorizer;
use Cog\YouTrack\Rest\Client\YouTrackClient;
use Cog\YouTrack\Rest\HttpClient\GuzzleHttpClient;
use Cog\YouTrack\Rest\Tests\AbstractTestCase;
use Cog\YouTrack\Rest\Tests\Traits\HasFakeHttpResponses;
use GuzzleHttp\Client as HttpClient;

abstract class AbstractFeatureTestCase extends AbstractTestCase
{
    use HasFakeHttpResponses;

    protected function initializeClient(): YouTrackClient
    {
        $http = new GuzzleHttpClient(new HttpClient([
            'base_uri' => $_SERVER['YOUTRACK_BASE_URI'],
        ]));
        $authorizer = new TokenAuthorizer($_SERVER['YOUTRACK_TOKEN']);

        return new YouTrackClient($http, $authorizer);
    }

    protected function stubsPath(string $path): string
    {
        return realpath(__DIR__ . '/stubs/' . $path);
    }
}
