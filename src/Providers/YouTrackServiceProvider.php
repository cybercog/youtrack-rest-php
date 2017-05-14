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

use Cog\YouTrack\Contracts\RestAuthenticator as RestAuthenticatorContract;
use Cog\YouTrack\Contracts\YouTrackClient as YouTrackClientContract;
use Cog\YouTrack\Services\YouTrackClient;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Contracts\Config\Repository as ConfigContract;
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
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootConfig();
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(YouTrackClientContract::class, function () {
            $config = $this->app->make(ConfigContract::class);

            $http = new HttpClient([
                'base_uri' => $config->get('youtrack.base_uri'),
            ]);

            return new YouTrackClient($http, $this->resolveAuthenticator($config));
        });
    }

    /**
     * Boot Laravel or Lumen config.
     *
     * @return void
     */
    protected function bootConfig(): void
    {
        $source = realpath(__DIR__ . '/../../config/youtrack.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('youtrack.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('youtrack');
        }

        $this->mergeConfigFrom($source, 'youtrack');
    }

    /**
     * Resolve Authenticator driver.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @return \Cog\YouTrack\Contracts\RestAuthenticator
     */
    protected function resolveAuthenticator(ConfigContract $config): RestAuthenticatorContract
    {
        $options = $config->get('youtrack.authenticators.' . $config->get('youtrack.authenticator'));

        return new $options['driver']($options);
    }
}
