<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DataSets;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\Client;
use Rugaard\WeatherKit\DataSets\Daily;
use Rugaard\WeatherKit\DTO\Coordinate;
use Rugaard\WeatherKit\DTO\Forecasts\Day;
use Rugaard\WeatherKit\DTO\Forecasts\Period;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\Measurements\Temperature;
use Rugaard\WeatherKit\DTO\Moon;
use Rugaard\WeatherKit\DTO\SunTimes;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Moon as MoonPhase;
use Rugaard\WeatherKit\Enums\Precipitation as PrecipitationType;
use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Exceptions\MissingCoordinateException;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;
use Rugaard\WeatherKit\Units\Length\Millimeter;
use Rugaard\WeatherKit\Units\Temperature\Celsius;

/**
 * DailyTest.
 *
 * @package Rugaard\WeatherKit\Tests\DataSets
 */
class DailyTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Daily forecast dataset.
     *
     * @var \Rugaard\WeatherKit\DataSets\Daily
     */
    protected Daily $data;

    /**
     * Day forecast data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Day
     */
    protected Day $day;

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
        $this->data = $data = $this->client->setClient(client: $this->mockForecastRequest())->daily();
        $this->day = $day = $data->getData()->first();
        $this->period = $day->getForecasts()->get(key: 'daytime');
    }

    /**
     * Test daily request without a location.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testAvailabilityWithoutLocation(): void
    {
        $this->expectException(exception: MissingCoordinateException::class);
        (new Client(token: 'MockedToken'))->daily();
    }

    /**
     * Test data instance.
     *
     * @return void
     */
    public function testDataInstance(): void
    {
        $this->assertInstanceOf(expected: Daily::class, actual: $this->data);
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getData());
        $this->assertCount(expectedCount: 10, haystack: $this->data->getData());
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
     * Test weather condition measurement.
     *
     * @return void
     */
    public function testCondition(): void
    {
        $this->assertInstanceOf(expected: WeatherCondition::class, actual: $this->day->getCondition());
        $this->assertEquals(expected: 'Clear', actual: $this->day->getCondition()->name);
        $this->assertEquals(expected: 'Clear', actual: $this->day->getCondition()->value);
    }

    /**
     * Test forecasts.
     *
     * @return void
     */
    public function testForecasts(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->day->getForecasts());
        $this->assertEquals(expected: ['daytime', 'overnight', 'restOfDay'], actual: $this->day->getForecasts()->keys()->toArray());
        $this->assertInstanceOf(expected: Period::class, actual: $this->day->getForecasts()->get('daytime'));
    }

    /**
     * Test forecast time.
     *
     * @return void
     */
    public function testForecastTime(): void
    {
        $this->assertInstanceOf(expected: TimePeriod::class, actual: $this->day->getForecastTime());

        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getForecastTime()->getStart());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->day->getForecastTime()->getStart()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T00:00:00.000+02:00', actual: $this->day->getForecastTime()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));

        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getForecastTime()->getEnd());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->day->getForecastTime()->getEnd()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-25T00:00:00.000+02:00', actual: $this->day->getForecastTime()->getEnd()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test max UV index.
     *
     * @return void
     */
    public function testMaxUVIndex(): void
    {
        $this->assertInstanceOf(expected: UVIndex::class, actual: $this->day->getMaxUVIndex());
        $this->assertEquals(expected: 'Five', actual: $this->day->getMaxUVIndex()->name);
        $this->assertEquals(expected: 5, actual: $this->day->getMaxUVIndex()->value);
        $this->assertEquals(expected: 'Moderate', actual: $this->day->getMaxUVIndex()->level());
        $this->assertEquals(expected: 'yellow', actual: $this->day->getMaxUVIndex()->colorName());
        $this->assertEquals(expected: '#f7b308', actual: $this->day->getMaxUVIndex()->colorAsHex());
        $this->assertEquals(expected: 'rgb(247, 179, 8)', actual: $this->day->getMaxUVIndex()->colorAsRGB());
    }

    /**
     * Test moon details.
     *
     * @return void
     */
    public function testMoon(): void
    {
        $this->assertInstanceOf(expected: Moon::class, actual: $this->day->getMoon());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getMoon()->getMoonrise());
        $this->assertEquals(expected: '2022-08-24T01:43:56.000+02:00', actual: $this->day->getMoon()->getMoonrise()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getMoon()->getMoonset());
        $this->assertEquals(expected: '2022-08-24T20:06:40.000+02:00', actual: $this->day->getMoon()->getMoonset()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: MoonPhase::class, actual: $this->day->getMoon()->getPhase());
        $this->assertEquals(expected: 'WaningCrescent', actual: $this->day->getMoon()->getPhase()->name);
        $this->assertEquals(expected: 'waningCrescent', actual: $this->day->getMoon()->getPhase()->value);
        $this->assertEquals(expected: 'A crescent-shaped sliver of the moon is visible, and decreasing in size', actual: $this->day->getMoon()->getPhase()->description());
    }

    /**
     * Test daily precipitation forecast.
     *
     * @return void
     */
    public function testPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->day->getPrecipitation());
        $this->assertEquals(expected: ['type', 'chance', 'amount', 'snowfall'], actual: $this->day->getPrecipitation()->keys()->toArray());

        $this->assertInstanceOf(expected: PrecipitationType::class, actual: $this->day->getPrecipitation()->get('type'));
        $this->assertEquals(expected: 'Rain', actual: $this->day->getPrecipitation()->get('type')->name);
        $this->assertEquals(expected: 'rain', actual: $this->day->getPrecipitation()->get('type')->value);

        $this->assertIsFloat(actual: $this->day->getPrecipitation()->get('chance'));
        $this->assertEquals(expected: 69.0, actual: $this->day->getPrecipitation()->get('chance'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->day->getPrecipitation()->get('amount'));
        $this->assertIsFloat(actual: $this->day->getPrecipitation()->get('amount')->getValue());
        $this->assertEquals(expected: 1.28, actual: $this->day->getPrecipitation()->get('amount')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->day->getPrecipitation()->get('amount')->getUnit());
        $this->assertEquals(expected: '1.28 mm', actual: (string) $this->day->getPrecipitation()->get('amount'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->day->getPrecipitation()->get('snowfall'));
        $this->assertIsFloat(actual: $this->day->getPrecipitation()->get('snowfall')->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->day->getPrecipitation()->get('snowfall')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->day->getPrecipitation()->get('snowfall')->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->day->getPrecipitation()->get('snowfall'));
    }

    /**
     * Test sun times.
     *
     * @return void
     */
    public function testSunTimes(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->day->getSunTimes());
        $this->assertEquals(expected: ['solarMidnight', 'solarNoon', 'sunrise', 'sunset'], actual: $this->day->getSunTimes()->keys()->toArray());

        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('solarMidnight'));
        $this->assertEquals(expected: '2022-08-24T01:12:38.000+02:00', actual: $this->day->getSunTimes()->get('solarMidnight')->format(format: DateTimeInterface::RFC3339_EXTENDED));

        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('solarNoon'));
        $this->assertEquals(expected: '2022-08-24T13:11:52.000+02:00', actual: $this->day->getSunTimes()->get('solarNoon')->format(format: DateTimeInterface::RFC3339_EXTENDED));

        $this->assertInstanceOf(expected: SunTimes::class, actual: $this->day->getSunTimes()->get('sunrise'));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('sunrise')->getTime());
        $this->assertEquals(expected: '2022-08-24T05:59:00.000+02:00', actual: $this->day->getSunTimes()->get('sunrise')->getTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('sunrise')->getCivil());
        $this->assertEquals(expected: '2022-08-24T05:18:27.000+02:00', actual: $this->day->getSunTimes()->get('sunrise')->getCivil()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('sunrise')->getNautical());
        $this->assertEquals(expected: '2022-08-24T04:26:01.000+02:00', actual: $this->day->getSunTimes()->get('sunrise')->getNautical()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('sunrise')->getAstronomical());
        $this->assertEquals(expected: '2022-08-24T03:20:49.000+02:00', actual: $this->day->getSunTimes()->get('sunrise')->getAstronomical()->format(format: DateTimeInterface::RFC3339_EXTENDED));

        $this->assertInstanceOf(expected: SunTimes::class, actual: $this->day->getSunTimes()->get('sunset'));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('sunset')->getTime());
        $this->assertEquals(expected: '2022-08-24T20:24:08.000+02:00', actual: $this->day->getSunTimes()->get('sunset')->getTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('sunset')->getCivil());
        $this->assertEquals(expected: '2022-08-24T21:04:27.000+02:00', actual: $this->day->getSunTimes()->get('sunset')->getCivil()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('sunset')->getNautical());
        $this->assertEquals(expected: '2022-08-24T21:56:28.000+02:00', actual: $this->day->getSunTimes()->get('sunset')->getNautical()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->day->getSunTimes()->get('sunset')->getAstronomical());
        $this->assertEquals(expected: '2022-08-24T23:00:19.000+02:00', actual: $this->day->getSunTimes()->get('sunset')->getAstronomical()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test temperature measurement.
     *
     * @return void
     */
    public function testTemperature(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->day->getTemperature());
        $this->assertEquals(expected: ['min', 'max'], actual: $this->day->getTemperature()->keys()->toArray());

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->day->getTemperature()->get('min'));
        $this->assertIsFloat(actual: $this->day->getTemperature()->get('min')->getValue());
        $this->assertEquals(expected: 16.24, actual: $this->day->getTemperature()->get('min')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->day->getTemperature()->get('min')->getUnit());
        $this->assertEquals(expected: '16.24 °C', actual: (string) $this->day->getTemperature()->get('min'));

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->day->getTemperature()->get('max'));
        $this->assertIsFloat(actual: $this->day->getTemperature()->get('max')->getValue());
        $this->assertEquals(expected: 24.3, actual: $this->day->getTemperature()->get('max')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->day->getTemperature()->get('max')->getUnit());
        $this->assertEquals(expected: '24.3 °C', actual: (string) $this->day->getTemperature()->get('max'));
    }
}
