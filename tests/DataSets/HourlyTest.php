<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DataSets;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\Client;
use Rugaard\WeatherKit\DataSets\Hourly;
use Rugaard\WeatherKit\DTO\Coordinate;
use Rugaard\WeatherKit\DTO\Forecasts\Hour;
use Rugaard\WeatherKit\DTO\Measurements\CloudCover;
use Rugaard\WeatherKit\DTO\Measurements\Humidity;
use Rugaard\WeatherKit\DTO\Measurements\Pressure;
use Rugaard\WeatherKit\DTO\Measurements\Visibility;
use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Exceptions\MissingCoordinateException;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;

/**
 * HourlyTest.
 *
 * @package Rugaard\WeatherKit\Tests\DataSets
 */
class HourlyTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Hourly forecast dataset.
     *
     * @var \Rugaard\WeatherKit\DataSets\Hourly
     */
    protected Hourly $data;

    /**
     * Hour forecast data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Hour
     */
    protected Hour $hour;

    /**
     * Set up test case.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $data = $this->client->setClient(client: $this->mockForecastRequest())->hourly();
        $this->hour = $data->getData()->first();
    }

    /**
     * Test hourly request without a location.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testAvailabilityWithoutLocation(): void
    {
        $this->expectException(exception: MissingCoordinateException::class);
        (new Client(token: 'MockedToken'))->hourly();
    }

    /**
     * Test data instance.
     *
     * @return void
     */
    public function testDataInstance(): void
    {
        $this->assertInstanceOf(expected: Hourly::class, actual: $this->data);
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getData());
        $this->assertCount(expectedCount: 243, haystack: $this->data->getData());
    }

    /**
     * Test location.
     *
     * @return void
     */
    public function testLocation(): void
    {
        $this->assertInstanceOf(expected: Coordinate::class, actual: $this->data->getLocation());
        $this->assertIsFloat(actual: $this->data->getLocation()->getLatitude());
        $this->assertEquals(expected: 55.674, actual: $this->data->getLocation()->getLatitude());
        $this->assertIsFloat(actual: $this->data->getLocation()->getLongitude());
        $this->assertEquals(expected: 12.568, actual: $this->data->getLocation()->getLongitude());

        $coordinate = (string) $this->data->getLocation();
        $this->assertIsString(actual: $coordinate);
        $this->assertEquals(expected: '55.674,12.568', actual: $coordinate);
    }

    /**
     * Test expire time.
     *
     * @return void
     */
    public function testExpireTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getExpireTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getExpireTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T19:35:03.000+02:00', actual: $this->data->getExpireTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test read time.
     *
     * @return void
     */
    public function testReadTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getReadTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getReadTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T18:35:03.000+02:00', actual: $this->data->getReadTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test reported time.
     *
     * @return void
     */
    public function testReportedTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getReportedTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getReportedTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T17:01:10.000+02:00', actual: $this->data->getReportedTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test version
     *
     * @return void
     */
    public function testVersion(): void
    {
        $this->assertIsInt(actual: $this->data->getVersion());
        $this->assertEquals(expected: 1, actual: $this->data->getVersion());
    }

    /**
     * Test cloud cover.
     *
     * @return void
     */
    public function testCloudCover(): void
    {
        $this->assertInstanceOf(expected: CloudCover::class, actual: $this->hour->getCloudCover());
    }

    /**
     * Test missing cloud cover measurement.
     *
     * @return void
     */
    public function testMissingCloudCover(): void
    {
        $this->hour->setCloudCover(cloudCover: null);
        $this->assertNull(actual: $this->hour->getCloudCover());
    }

    /**
     * Test weather condition measurement.
     *
     * @return void
     */
    public function testCondition(): void
    {
        $this->assertInstanceOf(expected: WeatherCondition::class, actual: $this->hour->getCondition());
    }

    /**
     * Test invalid weather condition measurement.
     *
     * @return void
     */
    public function testInvalidCondition(): void
    {
        $this->hour->setCondition(condition: 'RainbowAndSunshine');
        $this->assertNull(actual: $this->hour->getCondition());
    }

    /**
     * Test forecast time.
     *
     * @return void
     */
    public function testForecastTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->hour->getForecastTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->hour->getForecastTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-23T22:00:00.000+02:00', actual: $this->hour->getForecastTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test isDaylight measurement.
     *
     * @return void
     */
    public function testGetDaylight(): void
    {
        $this->assertIsBool(actual: $this->hour->getDaylight());
        $this->assertFalse(condition: $this->hour->getDaylight());
    }

    /**
     * Test missing isDaylight measurement.
     *
     * @return void
     */
    public function testMissingGetDaylight(): void
    {
        $this->hour->setDaylight(isDaylight: null);
        $this->assertNull(actual: $this->hour->getDaylight());
    }

    /**
     * Test humidity measurement.
     *
     * @return void
     */
    public function testHumidity(): void
    {
        $this->assertInstanceOf(expected: Humidity::class, actual: $this->hour->getHumidity());
    }

    /**
     * Test daily precipitation forecast.
     *
     * @return void
     */
    public function testPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->hour->getPrecipitation());
        $this->assertEquals(expected: ['type', 'chance', 'intensity', 'amount', 'snowfall'], actual: $this->hour->getPrecipitation()->keys()->toArray());
    }

    /**
     * Test pressure measurement.
     *
     * @return void
     */
    public function testPressure(): void
    {
        $this->assertInstanceOf(expected: Pressure::class, actual: $this->hour->getPressure());
    }

    /**
     * Test temperature measurement.
     *
     * @return void
     */
    public function testTemperature(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->hour->getTemperature());
        $this->assertEquals(expected: ['value', 'apparent', 'dewPoint'], actual: $this->hour->getTemperature()->keys()->toArray());
    }

    /**
     * Test UV index measurement.
     *
     * @return void
     */
    public function testUVIndex(): void
    {
        $this->assertInstanceOf(expected: UVIndex::class, actual: $this->hour->getUVIndex());
    }

    /**
     * Test visibility measurement.
     *
     * @return void
     */
    public function testVisibility(): void
    {
        $this->assertInstanceOf(expected: Visibility::class, actual: $this->hour->getVisibility());
    }

    /**
     * Test wind measurement.
     *
     * @return void
     */
    public function testWind(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->hour->getWind());
    }
}
