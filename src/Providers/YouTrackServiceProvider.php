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

namespace Cog\YouTrack\Providers;

use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Services\YouTrackClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Class YouTrackServiceProvider.
 *
 * @package Cog\YouTrack\Providers
 */
class YouTrackServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->bootConfig();
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->bind(YouTrackClientContract::class, function () {
            $config = $this->app->make('config');

            $http = new Client([
                'base_uri' => $config->get('youtrack.base_uri'),
            ]);

            return new YouTrackClient($http, [
                'username' => $config->get('youtrack.username'),
                'password' => $config->get('youtrack.password'),
            ]);
        });
    }

    protected function bootConfig()
    {
        $source = realpath(__DIR__ . '/../../config/youtrack.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('youtrack.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('youtrack');
        }

        $this->mergeConfigFrom($source, 'youtrack');
    }
}
