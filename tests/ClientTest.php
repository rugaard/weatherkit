<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests;

use Rugaard\WeatherKit\Client;
use Rugaard\WeatherKit\DataSets\Alerts;
use Rugaard\WeatherKit\DataSets\Currently;
use Rugaard\WeatherKit\DataSets\Daily;
use Rugaard\WeatherKit\DataSets\Hourly;
use Rugaard\WeatherKit\DataSets\NextHour;
use Rugaard\WeatherKit\Exceptions\ClientException;
use Rugaard\WeatherKit\Exceptions\InvalidTimezoneException;
use Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException;
use Rugaard\WeatherKit\Exceptions\MissingCoordinateException;
use Rugaard\WeatherKit\Exceptions\RequestException;
use Rugaard\WeatherKit\Exceptions\ServerException;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;
use Illuminate\Support\Collection;

/**
 * ClientTest.
 *
 * @package Rugaard\WeatherKit\Tests
 */
class ClientTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Test invalid timezone.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     */
    public function testInvalidTimezone(): void
    {
        $this->expectException(exception: InvalidTimezoneException::class);
        $this->expectExceptionMessage(message: 'Invalid timezone provided');

        new Client(token: 'MockedToken', latitude: 0.0, longitude: 0.0, countryCode: 'mockedCountryCode', languageCode: 'mockedLanguageCode', timezone: 'Mocked/Timezone');
    }

    /**
     * Test availability request.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testAvailability(): void
    {
        $data = $this->client->setClient(client: $this->mockAvailabilityRequest())->availability();

        $this->assertIsArray(actual: $data);
        $this->assertCount(expectedCount: 5, haystack: $data);
        $this->assertEquals(expected: ['currentWeather', 'forecastDaily', 'forecastHourly', 'forecastNextHour', 'weatherAlerts'], actual: $data);
    }

    /**
     * Test availability request without a location.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testAvailabilityWithoutLocation(): void
    {
        $this->expectException(MissingCoordinateException::class);
        (new Client(token: 'MockedToken'))->availability();
    }

    /**
     * Test weather request.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testWeather(): void
    {
        $data = $this->client->setClient(client: $this->mockForecastRequest())->weather();

        $this->assertInstanceOf(expected: Collection::class, actual: $data);
        $this->assertEquals(expected: ['currently', 'daily', 'hourly', 'nextHour', 'alerts'], actual: $data->keys()->toArray());
        $this->assertInstanceOf(expected: Currently::class, actual: $data->get('currently'));
        $this->assertInstanceOf(expected: Daily::class, actual: $data->get('daily'));
        $this->assertInstanceOf(expected: Hourly::class, actual: $data->get('hourly'));
        $this->assertInstanceOf(expected: NextHour::class, actual: $data->get('nextHour'));
        $this->assertInstanceOf(expected: Alerts::class, actual: $data->get('alerts'));
    }

    /**
     * Test weather request without a location.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testWeatherWithoutLocation(): void
    {
        $this->expectException(MissingCoordinateException::class);
        (new Client(token: 'MockedToken'))->weather();
    }

    /**
     * Test weather containing unsupported data set.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testWeatherUnsupportedDataSet(): void
    {
        $data = $this->client->setClient(client: $this->mockForecastUnsupportedDataSetRequest())->weather();

        $this->assertInstanceOf(expected: Collection::class, actual: $data);
        $this->assertFalse(condition: $data->has('mockedDataSet'));
    }

    /**
     * Test weather with empty response.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testWeatherEmpty(): void
    {
        $data = $this->client->setClient(client: $this->mockNoContentRequest())->weather();

        $this->assertInstanceOf(expected: Collection::class, actual: $data);
        $this->assertTrue(condition: $data->isEmpty());
    }

    /**
     * Test invalid JSON response.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testInvalidJson(): void
    {
        $weatherKit = $this->client->setClient(client: $this->mockInvalidJsonRequest());

        $this->expectException(exception: JsonDecodeFailedException::class);
        $this->expectExceptionMessage(message: 'Failed to decode response');
        $this->invokeMethod(object: $weatherKit, methodName: 'request', parameters: ['http://mocked.url']);
    }

    /**
     * Test "204 No Content" request.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testNoContentRequest(): void
    {
        $weatherKit = $this->client->setClient(client: $this->mockNoContentRequest());

        $data = $this->invokeMethod(object: $weatherKit, methodName: 'request', parameters: ['http://mocked.url']);

        $this->assertIsArray(actual: $data);
        $this->assertCount(expectedCount: 0, haystack: $data);
    }

    /**
     * Test client exception.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testClientException(): void
    {
        $weatherKit = $this->client->setClient(client: $this->mockNotFoundRequest());

        $this->expectException(exception: ClientException::class);
        $this->expectExceptionMessage(message: 'Client error: `GET http://mocked.url` resulted in a `404 Not Found` response');

        $this->invokeMethod(object: $weatherKit, methodName: 'request', parameters: ['http://mocked.url']);
    }

    /**
     * Test server exception.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testServerException(): void
    {
        $weatherKit = $this->client->setClient(client: $this->mockInternalErrorRequest());

        $this->expectException(exception: ServerException::class);
        $this->expectExceptionMessage(message: 'Server error: `GET http://mocked.url` resulted in a `500 Internal Server Error` response');

        $this->invokeMethod(object: $weatherKit, methodName: 'request', parameters: ['http://mocked.url']);
    }

    /**
     * Test request exception.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testRequestException(): void
    {
        $this->expectException(exception: RequestException::class);

        $this->invokeMethod(object: $this->client, methodName: 'request', parameters: ['http://mockedurl']);
    }
}
