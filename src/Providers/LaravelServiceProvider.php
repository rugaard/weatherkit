<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Rugaard\WeatherKit\Client;
use Rugaard\WeatherKit\Exceptions\DecodingKeyFailedException;
use Rugaard\WeatherKit\Exceptions\KeyNotFoundException;
use Rugaard\WeatherKit\Exceptions\TokenFailedException;
use Rugaard\WeatherKit\Exceptions\WeatherKitException;
use Rugaard\WeatherKit\Token;

/**
 * Class LaravelServiceProvider
 *
 * @package Rugaard\DMI\Providers
 */
class LaravelServiceProvider extends IlluminateServiceProvider
{
    /**
     * Boot service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        // Use package configuration as fallback
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/laravel.php',
            'weatherkit'
        );

        // Publish config file.
        $this->publishes([
            __DIR__ . '/../../config/laravel.php' => config_path('weatherkit.php'),
        ], 'weatherkit');
    }

    /**
     * Register service provider.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     * @throws \Rugaard\WeatherKit\Exceptions\WeatherKitException
     */
    public function register(): void
    {
        $this->app->singleton('rugaard.weatherkit', function ($app) {
            // Get configuration.
            $config = config('weatherkit', []);

            try {
                // Generate token.
                $token = new Token($config['auth']['filepath'], $config['auth']['keyId'], $config['auth']['appPrefixId'], $config['auth']['bundleId']);
            } catch (DecodingKeyFailedException | KeyNotFoundException | TokenFailedException $e) {
                throw new WeatherKitException($e->getMessage(), $e->getCode(), $e);
            }

            // Instantiate WeatherKit client.
            return new Client((string) $token, null, null, null, $config['languageCode'], $config['timezone']);
        });

        $this->app->bind(Client::class, function ($app) {
            return $app['rugaard.weatherkit'];
        });
    }
    /**
     * Get the services provided by this provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['rugaard.weatherkit'];
    }
}
