<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DataSets;

use DateTime;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DataSets\Currently;
use Rugaard\WeatherKit\DTO\Coordinate;
use Rugaard\WeatherKit\DTO\Measurements\CloudCover;
use Rugaard\WeatherKit\DTO\Measurements\Humidity;
use Rugaard\WeatherKit\DTO\Measurements\Pressure;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\Measurements\Visibility;
use Rugaard\WeatherKit\DTO\Provider;
use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;

/**
 * AbstractDataSetTest.
 *
 * @package Rugaard\WeatherKit\Tests\DataSets
 */
class AbstractDataSetTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Currently dataset.
     *
     * @var \Rugaard\WeatherKit\DataSets\Currently
     */
    protected Currently $data;

    /**
     * Set up test case.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException|
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->data = $this->client->setClient(client: $this->mockForecastRequest())->currently();
    }

    /**
     * Test toArray.
     *
     * @return void
     */
    public function testToArray(): void
    {
        // Convert data to array.
        $data = $this->data->toArray();

        $this->assertIsArray(actual: $data);
        $this->assertArrayNotHasKey(key: 'timezone', array: $data);
        $this->assertArrayHasKey(key: 'location', array: $data);
        $this->assertInstanceOf(expected: Coordinate::class, actual: $data['location']);
        $this->assertArrayHasKey(key: 'provider', array: $data);
        $this->assertInstanceOf(expected: Provider::class, actual: $data['provider']);
        $this->assertIsString($data['legalUrl']);
        $this->assertEquals(expected: 'https://weatherkit.apple.com/legal-attribution.html', actual: $data['legalUrl']);
        $this->assertArrayHasKey(key: 'expireTime', array: $data);
        $this->assertInstanceOf(expected: DateTime::class, actual: $data['expireTime']);
        $this->assertEquals(expected: $this->timezone->getName(), actual: $data['expireTime']->getTimezone()->getName());
        $this->assertArrayHasKey(key: 'readTime', array: $data);
        $this->assertInstanceOf(expected: DateTime::class, actual: $data['readTime']);
        $this->assertEquals(expected: $this->timezone->getName(), actual: $data['readTime']->getTimezone()->getName());
        $this->assertArrayHasKey(key: 'reportedTime', array: $data);
        $this->assertInstanceOf(expected: DateTime::class, actual: $data['reportedTime']);
        $this->assertEquals(expected: $this->timezone->getName(), actual: $data['reportedTime']->getTimezone()->getName());
        $this->assertArrayHasKey(key: 'version', array: $data);
        $this->assertIsInt(actual: $data['version']);
        $this->assertArrayHasKey(key: 'cloudCover', array: $data);
        $this->assertInstanceOf(expected: CloudCover::class, actual: $data['cloudCover']);
        $this->assertArrayHasKey(key: 'condition', array: $data);
        $this->assertInstanceOf(expected: WeatherCondition::class, actual: $data['condition']);
        $this->assertArrayHasKey(key: 'forecastTime', array: $data);
        $this->assertInstanceOf(expected: DateTime::class, actual: $data['forecastTime']);
        $this->assertEquals(expected: $this->timezone->getName(), actual: $data['forecastTime']->getTimezone()->getName());
        $this->assertArrayHasKey(key: 'daylight', array: $data);
        $this->assertIsBool(actual: $data['daylight']);
        $this->assertArrayHasKey(key: 'humidity', array: $data);
        $this->assertInstanceOf(expected: Humidity::class, actual: $data['humidity']);
        $this->assertArrayHasKey(key: 'precipitation', array: $data);
        $this->assertInstanceOf(expected: Precipitation::class, actual: $data['precipitation']);
        $this->assertArrayHasKey(key: 'pressure', array: $data);
        $this->assertInstanceOf(expected: Pressure::class, actual: $data['pressure']);
        $this->assertArrayHasKey(key: 'temperature', array: $data);
        $this->assertInstanceOf(expected: Collection::class, actual: $data['temperature']);
        $this->assertArrayHasKey(key: 'uvIndex', array: $data);
        $this->assertInstanceOf(expected: UVIndex::class, actual: $data['uvIndex']);
        $this->assertArrayHasKey(key: 'visibility', array: $data);
        $this->assertInstanceOf(expected: Visibility::class, actual: $data['visibility']);
        $this->assertArrayHasKey(key: 'wind', array: $data);
        $this->assertInstanceOf(expected: Collection::class, actual: $data['wind']);
    }
}
