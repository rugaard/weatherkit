<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DataSets;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\Client;
use Rugaard\WeatherKit\DataSets\NextHour;
use Rugaard\WeatherKit\DTO\Coordinate;
use Rugaard\WeatherKit\DTO\Forecasts\Minute;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Precipitation as PrecipitationType;
use Rugaard\WeatherKit\Exceptions\MissingCoordinateException;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;
use Rugaard\WeatherKit\Units\Length\Millimeter;

/**
 * NextHourTest.
 *
 * @package Rugaard\WeatherKit\Tests\DataSets
 */
class NextHourTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Hourly forecast dataset.
     *
     * @var \Rugaard\WeatherKit\DataSets\NextHour
     */
    protected NextHour $data;

    /**
     * Hour forecast data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Minute
     */
    protected Minute $minute;

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
        $this->data = $data = $this->client->setClient(client: $this->mockForecastRequest())->nextHour();
        $this->minute = $data->getData()->first();
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
        (new Client(token: 'MockedToken'))->nextHour();
    }

    /**
     * Test data instance.
     *
     * @return void
     */
    public function testDataInstance(): void
    {
        $this->assertInstanceOf(expected: NextHour::class, actual: $this->data);
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getData());
        $this->assertCount(expectedCount: 75, haystack: $this->data->getData());
    }

    /**
     * Test location.
     *
     * @return void
     */
    public function testLocation(): void
    {
        $this->assertInstanceOf(expected: Coordinate::class, actual: $this->data->getLocation());
        $this->assertIsFloat($this->data->getLocation()->getLatitude());
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
        $this->assertEquals(expected: '2022-08-24T16:08:29.000+02:00', actual: $this->data->getExpireTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
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
        $this->assertEquals(expected: '2022-08-24T14:08:29.000+02:00', actual: $this->data->getReadTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
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
     * Test forecast time.
     *
     * @return void
     */
    public function testForecastTime(): void
    {
        $this->assertInstanceOf(expected: TimePeriod::class, actual: $this->data->getForecastTime());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getForecastTime()->getStart());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getForecastTime()->getStart()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T14:09:00.000+02:00', actual: $this->data->getForecastTime()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getForecastTime()->getEnd());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getForecastTime()->getEnd()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T15:24:00.000+02:00', actual: $this->data->getForecastTime()->getEnd()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test precipitation
     *
     * @return void
     */
    public function testPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getPrecipitation());
        $this->assertEquals(expected: ['type', 'chance', 'intensity'], actual: $this->data->getPrecipitation()->keys()->toArray());

        $this->assertInstanceOf(expected: PrecipitationType::class, actual: $this->data->getPrecipitation()->get('type'));
        $this->assertEquals(expected: 'Clear', actual: $this->data->getPrecipitation()->get('type')->name);
        $this->assertEquals(expected: 'clear', actual: $this->data->getPrecipitation()->get('type')->value);

        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('chance'));
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('chance'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get('intensity'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('intensity')->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('intensity')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get('intensity')->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->data->getPrecipitation()->get('intensity'));
    }

    /**
     * Test minutely forecast time.
     *
     * @return void
     */
    public function testMinutelyForecastTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->minute->getForecastTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->minute->getForecastTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T14:09:00.000+02:00', actual: $this->minute->getForecastTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test minutely precipitation.
     *
     * @return void
     */
    public function testMinutelyPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->minute->getPrecipitation());
        $this->assertEquals(expected: ['chance', 'intensity'], actual: $this->minute->getPrecipitation()->keys()->toArray());
    }
}
