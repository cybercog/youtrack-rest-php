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

namespace Cog\Contracts\YouTrack\Rest\Authorizer\Exceptions;

use Cog\Contracts\YouTrack\Rest\Client\Exceptions\ClientException;

class AuthorizationException extends ClientException
{
}
