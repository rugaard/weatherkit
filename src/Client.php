<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit;

use DateTimeZone;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Exception\ServerException as GuzzleServerException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use JsonException;
use Rugaard\WeatherKit\DataSets\Alerts;
use Rugaard\WeatherKit\DataSets\Currently;
use Rugaard\WeatherKit\DataSets\Daily;
use Rugaard\WeatherKit\DataSets\Hourly;
use Rugaard\WeatherKit\DataSets\NextHour;
use Rugaard\WeatherKit\DTO\Forecasts\AlertDetails;
use Rugaard\WeatherKit\Exceptions\ClientException;
use Rugaard\WeatherKit\Exceptions\InvalidTimezoneException;
use Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException;
use Rugaard\WeatherKit\Exceptions\MissingCoordinateException;
use Rugaard\WeatherKit\Exceptions\RequestException;
use Rugaard\WeatherKit\Exceptions\ServerException;
use Throwable;

use function array_intersect;
use function array_keys;
use function array_key_exists;
use function array_merge;
use function http_build_query;
use function implode;
use function json_decode;
use function lcfirst;
use function strrpos;
use function strtoupper;
use function substr;

use const JSON_THROW_ON_ERROR;

/**
 * Client.
 *
 * @package Rugaard\WeatherKit
 */
class Client
{
    /**
     * WeatherKit API Base URL.
     */
    protected const BASE_URL = 'https://weatherkit.apple.com/api/v1/';

    /**
     * JWT Token.
     *
     * @var string
     */
    protected string $token;

    /**
     * Latitude position.
     *
     * @var float|null
     */
    protected ?float $latitude;

    /**
     * Longitude position.
     *
     * @var float|null
     */
    protected ?float $longitude;

    /**
     * Default country code.
     *
     * @var string|null
     */
    protected ?string $countryCode;

    /**
     * Default language code.
     *
     * @var string
     */
    protected string $languageCode;

    /**
     * Timezone of client.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * HTTP Client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected ClientInterface $client;

    /**
     * Supported data sets.
     *
     * @var array
     */
    protected array $supportedDataSets = [
        'currentWeather' => Currently::class,
        'forecastDaily' => Daily::class,
        'forecastHourly' => Hourly::class,
        'forecastNextHour' => NextHour::class,
        'weatherAlerts' => Alerts::class,
    ];

    /**
     * Create WeatherKit client.
     *
     * @param string $token
     * @param float|null $latitude
     * @param float|null $longitude
     * @param string|null $countryCode
     * @param string $languageCode
     * @param string $timezone
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     */
    public function __construct(string $token, ?float $latitude = null, ?float $longitude = null, ?string $countryCode = null, string $languageCode = 'en', string $timezone = 'UTC')
    {
        // Set JWT token.
        $this->token = $token;

        // Set Location.
        $this->setLocation(latitude: $latitude, longitude: $longitude, countryCode: $countryCode);

        // Set country and language.
        $this->setLanguage(languageCode: $languageCode);

        // Set default HTTP client.
        $this->setDefaultClient();

        try {
            // Set timezone.
            $this->setTimezone($timezone);
        } catch (Throwable $e) {
            throw new InvalidTimezoneException(message: 'Invalid timezone provided.', code: 400, previous: $e);
        }
    }

    /**
     * Get available data sets from specified location.
     *
     * @return array
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function availability(): array
    {
        // Validate location coordinate.
        if ($this->latitude === null || $this->longitude === null) {
            throw new MissingCoordinateException('Missing location coordinate [latitude/longitude].');
        }

        return $this->request(endpoint: 'availability/' . $this->latitude . '/' . $this->longitude . '/' . ($this->countryCode !== null ? '?country=' . $this->countryCode : ''));
    }

    /**
     * Get weather forecasts.
     *
     * @param array $dataSets
     * @param array $options
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function weather(array $dataSets = [], array $options = []): Collection
    {
        // Only use supported data sets.
        $dataSets = array_intersect(array_keys(array: $this->supportedDataSets), $dataSets);

        // Forecast container.
        $forecasts = Collection::make();

        // Validate location coordinate.
        if ($this->latitude === null || $this->longitude === null) {
            throw new MissingCoordinateException('Missing location coordinate [latitude/longitude].');
        }

        // Request data from API.
        $response = $this->request(endpoint: 'weather/' . $this->languageCode . '/' . $this->latitude . '/' . $this->longitude . '?' . http_build_query(data: array_merge([
            'dataSets' => implode(separator: ',', array: !empty($dataSets) ? $dataSets : array_keys(array: $this->supportedDataSets)),
        ], $options, [
            'timezone' => $this->timezone->getName()
        ], $this->countryCode !== null ? ['country' => $this->countryCode] : [])));

        // Validate data.
        if (empty($response)) {
            return $forecasts;
        }

        // Parse available weather forecasts.
        foreach ($response as $forecast => $data) {
            // If forecast contains no data
            // or is not supported, we're skipping it.
            if (empty($data) || !array_key_exists(key: $forecast, array: $this->supportedDataSets)) {
                continue;
            }

            // Add forecast to collection.
            $forecasts->put(
                key: lcfirst(string: substr(string: $this->supportedDataSets[$forecast], offset: strrpos(haystack: $this->supportedDataSets[$forecast], needle: '\\') + 1)),
                value: new $this->supportedDataSets[$forecast](data: $data, timezone: $this->timezone)
            );
        }

        return $forecasts;
    }

    /**
     * Get current weather forecast.
     *
     * @param array $options
     * @return \Rugaard\WeatherKit\DataSets\Currently
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function currently(array $options = []): Currently
    {
        // Validate location coordinate.
        if ($this->latitude === null || $this->longitude === null) {
            throw new MissingCoordinateException('Missing location coordinate [latitude/longitude].');
        }

        // Request data from API.
        $data = $this->request(endpoint: 'weather/' . $this->languageCode . '/' . $this->latitude . '/' . $this->longitude . '?' . http_build_query(data: array_merge([
            'dataSets' => 'currentWeather'
        ], $options, [
            'timezone' => $this->timezone->getName()
        ], $this->countryCode !== null ? ['country' => $this->countryCode] : [])));

        return new Currently(data: $data['currentWeather'] ?? [], timezone: $this->timezone);
    }

    /**
     * Get next hour weather forecast.
     *
     * @param array $options
     * @return \Rugaard\WeatherKit\DataSets\NextHour
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function nextHour(array $options = []): NextHour
    {
        // Validate location coordinate.
        if ($this->latitude === null || $this->longitude === null) {
            throw new MissingCoordinateException('Missing location coordinate [latitude/longitude].');
        }

        // Request data from API.
        $data = $this->request(endpoint: 'weather/' . $this->languageCode . '/' . $this->latitude . '/' . $this->longitude . '?' . http_build_query(data: array_merge([
                'dataSets' => 'forecastNextHour',
            ], $options, [
                'timezone' => $this->timezone->getName()
            ], $this->countryCode !== null ? ['country' => $this->countryCode] : [])));

        return new NextHour(data: $data['forecastNextHour'] ?? [], timezone: $this->timezone);
    }

    /**
     * Get hourly weather forecast.
     *
     * @param array $options
     * @return \Rugaard\WeatherKit\DataSets\Hourly
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function hourly(array $options = []): Hourly
    {
        // Validate location coordinate.
        if ($this->latitude === null || $this->longitude === null) {
            throw new MissingCoordinateException('Missing location coordinate [latitude/longitude].');
        }

        // Request data from API.
        $data = $this->request(endpoint: 'weather/' . $this->languageCode . '/' . $this->latitude . '/' . $this->longitude . '?' . http_build_query(data: array_merge([
            'dataSets' => 'forecastHourly',
        ], $options, [
            'timezone' => $this->timezone->getName()
        ], $this->countryCode !== null ? ['country' => $this->countryCode] : [])));

        return new Hourly(data: $data['forecastHourly'] ?? [], timezone: $this->timezone);
    }

    /**
     * Get daily weather forecast.
     *
     * @param array $options
     * @return \Rugaard\WeatherKit\DataSets\Daily
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function daily(array $options = []): Daily
    {
        // Validate location coordinate.
        if ($this->latitude === null || $this->longitude === null) {
            throw new MissingCoordinateException('Missing location coordinate [latitude/longitude].');
        }

        // Request data from API.
        $data = $this->request(endpoint: 'weather/' . $this->languageCode . '/' . $this->latitude . '/' . $this->longitude . '?' . http_build_query(data: array_merge([
            'dataSets' => 'forecastDaily'
        ], $options, [
            'timezone' => $this->timezone->getName()
        ], $this->countryCode !== null ? ['country' => $this->countryCode] : [])));

        return new Daily(data: $data['forecastDaily'] ?? [], timezone: $this->timezone);
    }

    /**
     * Get weather alerts.
     *
     * @param array $options
     * @return \Rugaard\WeatherKit\DataSets\Alerts
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function alerts(array $options = []): Alerts
    {
        // Validate location coordinate.
        if ($this->latitude === null || $this->longitude === null) {
            throw new MissingCoordinateException('Missing location coordinate [latitude/longitude].');
        }

        // Request data from API.
        $data = $this->request(endpoint: 'weather/' . $this->languageCode . '/' . $this->latitude . '/' . $this->longitude . '?' . http_build_query(data: array_merge([
            'dataSets' => 'weatherAlerts'
        ], $options, [
            'timezone' => $this->timezone->getName()
        ], $this->countryCode !== null ? ['country' => $this->countryCode] : [])));

        return new Alerts(data: $data['weatherAlerts'] ?? [], timezone: $this->timezone);
    }

    /**
     * Get details about a specific weather alert.
     *
     * @param string $alertId
     * @return \Rugaard\WeatherKit\DTO\Forecasts\AlertDetails
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     */
    public function alert(string $alertId): AlertDetails
    {
        // Request data from API.
        $data = $this->request(endpoint: 'weatherAlert/' . $this->languageCode . '/' . $alertId . '?' . http_build_query(data: array_merge([
            'timezone' => $this->timezone->getName()
        ])));

        return new AlertDetails(data: $data ?? [], timezone: $this->timezone);
    }

    /**
     * Send request to API.
     *
     * @param string $endpoint
     * @return array
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\ServerException
     * @throws \Rugaard\WeatherKit\Exceptions\ClientException
     * @throws \Rugaard\WeatherKit\Exceptions\RequestException
     */
    protected function request(string $endpoint): array
    {
        try {
            // Send request.
            $response = $this->client->request(method: 'get', uri: $endpoint, options: [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'gzip',
                    'Authorization' => 'Bearer ' . $this->token
                ]
            ]);

            // If response is a 204 (No Content),
            // then return an empty array.
            if ($response->getStatusCode() === 204) {
                return [];
            }

            // Extract body from response.
            $body = (string) $response->getBody();

            // JSON Decode response.
            return json_decode(json: $body, associative: true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new JsonDecodeFailedException(message: 'Failed to decode response', code: 500, previous: $e);
        } catch (GuzzleServerException $e) {
            throw new ServerException(message: $e->getMessage(), request: $e->getRequest(), response: $e->getResponse(), previous: $e);
        } catch (GuzzleClientException $e) {
            throw new ClientException(message: $e->getMessage(), request: $e->getRequest(), response: $e->getResponse(), previous: $e);
        } catch (GuzzleException $e) {
            throw new RequestException(message: $e->getMessage(), code: $e->getCode(), previous: $e);
        }
    }

    /**
     * Set location coordinate.
     *
     * @param float|null $latitude
     * @param float|null $longitude
     * @param string|null $countryCode
     * @return $this
     */
    public function setLocation(?float $latitude, ?float $longitude, ?string $countryCode = null): self
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        if ($countryCode !== null) {
            $this->countryCode = strtoupper(string: $countryCode);
        }

        return $this;
    }

    /**
     * Set language code.
     *
     * @param string $languageCode
     * @return $this
     */
    public function setLanguage(string $languageCode): self
    {
        $this->languageCode = $languageCode;
        return $this;
    }

    /**
     * Set timezone.
     *
     * @param string $timezone
     * @return $this
     */
    public function setTimezone(string $timezone): self
    {
        $this->timezone = new DateTimeZone(timezone: $timezone);
        return $this;
    }

    /**
     * Set a default HTTP client instance.
     *
     * @return void
     */
    protected function setDefaultClient(): void
    {
        $this->setClient(client: new GuzzleClient(config: [
            'base_uri' => self::BASE_URL
        ]));
    }

    /**
     * Set HTTP client instance.
     *
     * @param  \GuzzleHttp\ClientInterface $client
     * @return $this
     */
    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;
        return $this;
    }
}
