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

namespace Cog\YouTrack\Tests\Unit\Providers;

use Cog\YouTrack\Contracts\ApiClient as ApiClientContract;
use Cog\YouTrack\Tests\TestCase;
use Cog\YouTrack\Rest\YouTrackClient;

/**
 * Class YouTrackServiceProviderTest.
 *
 * @package Cog\YouTrack\Tests\Unit\Providers
 */
class YouTrackServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_youtrack_client_from_container()
    {
        $client = $this->app->make(ApiClientContract::class);

        $this->assertInstanceOf(YouTrackClient::class, $client);
    }
}
