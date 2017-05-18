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

namespace Cog\YouTrack\Rest\Tests;

use Cog\YouTrack\Rest\Tests\Traits\HasFakeHttpResponses;

/**
 * Class TestCase.
 *
 * @package Cog\YouTrack\Rest\Tests
 */
abstract class FeatureTestCase extends TestCase
{
    use HasFakeHttpResponses;
}
