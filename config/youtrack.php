<?php

/*
 * This file is part of YouTrack REST PHP.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'base_uri' => env('YOUTRACK_BASE_URI'),
    'auth' => [
        'driver' => env('YOUTRACK_AUTH', 'token'),

        'drivers' => [
            'token' => [
                'class' => \Cog\YouTrack\Authenticators\TokenAuthenticator::class,
                'token' => env('YOUTRACK_TOKEN'),
            ],

            'cookie' => [
                'class' => \Cog\YouTrack\Authenticators\CookieAuthenticator::class,
                'username' => env('YOUTRACK_USERNAME'),
                'password' => env('YOUTRACK_PASSWORD'),
            ],
        ],
    ],
];
