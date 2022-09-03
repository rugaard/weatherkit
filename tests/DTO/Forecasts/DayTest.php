<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Forecasts;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Day;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\Measurements\Temperature;
use Rugaard\WeatherKit\DTO\Moon;
use Rugaard\WeatherKit\DTO\SunTimes;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Moon as MoonPhase;
use Rugaard\WeatherKit\Enums\Precipitation as PrecipitationType;
use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;
use Rugaard\WeatherKit\Units\Length\Millimeter;
use Rugaard\WeatherKit\Units\Temperature\Celsius;

/**
 * DayTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Forecasts
 */
class DayTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Day data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Day
     */
    protected Day $data;

    /**
     * Set up test case.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->data = $this->client->setClient(client: $this->mockForecastRequest())->daily()->getData()->first();
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
        $this->assertEquals(expected: '2022-08-24T00:00:00.000+02:00', actual: $this->data->getForecastTime()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));

        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getForecastTime()->getEnd());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getForecastTime()->getEnd()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-25T00:00:00.000+02:00', actual: $this->data->getForecastTime()->getEnd()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test max UV index.
     *
     * @return void
     */
    public function testMaxUVIndex(): void
    {
        $this->assertInstanceOf(expected: UVIndex::class, actual: $this->data->getMaxUVIndex());
        $this->assertEquals(expected: 'Five', actual: $this->data->getMaxUVIndex()->name);
        $this->assertEquals(expected: 5, actual: $this->data->getMaxUVIndex()->value);
        $this->assertEquals(expected: 'Moderate', actual: $this->data->getMaxUVIndex()->level());
        $this->assertEquals(expected: 'yellow', actual: $this->data->getMaxUVIndex()->colorName());
        $this->assertEquals(expected: '#f7b308', actual: $this->data->getMaxUVIndex()->colorAsHex());
        $this->assertEquals(expected: 'rgb(247, 179, 8)', actual: $this->data->getMaxUVIndex()->colorAsRGB());
    }

    /**
     * Test moon details.
     *
     * @return void
     */
    public function testMoon(): void
    {
        $this->assertInstanceOf(expected: Moon::class, actual: $this->data->getMoon());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getMoon()->getMoonrise());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getMoon()->getMoonrise()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T01:43:56.000+02:00', actual: $this->data->getMoon()->getMoonrise()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getMoon()->getMoonset());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getMoon()->getMoonset()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T20:06:40.000+02:00', actual: $this->data->getMoon()->getMoonset()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: MoonPhase::class, actual: $this->data->getMoon()->getPhase());
        $this->assertEquals(expected: 'WaningCrescent', actual: $this->data->getMoon()->getPhase()->name);
        $this->assertEquals(expected: 'waningCrescent', actual: $this->data->getMoon()->getPhase()->value);
        $this->assertEquals(expected: 'A crescent-shaped sliver of the moon is visible, and decreasing in size', actual: $this->data->getMoon()->getPhase()->description());
    }

    /**
     * Test daily precipitation forecast.
     *
     * @return void
     */
    public function testPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getPrecipitation());
        $this->assertEquals(expected: ['type', 'chance', 'amount', 'snowfall'], actual: $this->data->getPrecipitation()->keys()->toArray());

        $this->assertInstanceOf(expected: PrecipitationType::class, actual: $this->data->getPrecipitation()->get(key: 'type'));
        $this->assertEquals(expected: 'Rain', actual: $this->data->getPrecipitation()->get(key: 'type')->name);
        $this->assertEquals(expected: 'rain', actual: $this->data->getPrecipitation()->get(key: 'type')->value);

        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get(key: 'chance'));
        $this->assertEquals(expected: 69.0, actual: $this->data->getPrecipitation()->get(key: 'chance'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get(key: 'amount'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get(key: 'amount')->getValue());
        $this->assertEquals(expected: 1.28, actual: $this->data->getPrecipitation()->get(key: 'amount')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get(key: 'amount')->getUnit());
        $this->assertEquals(expected: '1.28 mm', actual: (string) $this->data->getPrecipitation()->get(key: 'amount'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get(key: 'snowfall'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get(key: 'snowfall')->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get(key: 'snowfall')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get(key: 'snowfall')->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->data->getPrecipitation()->get(key: 'snowfall'));
    }

    /**
     * Test sun times.
     *
     * @return void
     */
    public function testSunTimes(): void
    {

        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getSunTimes());
        $this->assertEquals(expected: ['solarMidnight', 'solarNoon', 'sunrise', 'sunset'], actual: $this->data->getSunTimes()->keys()->toArray());

        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key:'solarMidnight'));
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'solarMidnight')->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T01:12:38.000+02:00', actual: $this->data->getSunTimes()->get(key: 'solarMidnight')->format(format: DateTimeInterface::RFC3339_EXTENDED));

        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'solarNoon'));
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'solarNoon')->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T13:11:52.000+02:00', actual: $this->data->getSunTimes()->get(key: 'solarNoon')->format(format: DateTimeInterface::RFC3339_EXTENDED));

        $this->assertInstanceOf(expected: SunTimes::class, actual: $this->data->getSunTimes()->get(key: 'sunrise'));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'sunrise')->getTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'sunrise')->getTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T05:59:00.000+02:00', actual: $this->data->getSunTimes()->get(key: 'sunrise')->getTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'sunrise')->getCivil());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'sunrise')->getCivil()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T05:18:27.000+02:00', actual: $this->data->getSunTimes()->get(key: 'sunrise')->getCivil()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'sunrise')->getNautical());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'sunrise')->getNautical()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T04:26:01.000+02:00', actual: $this->data->getSunTimes()->get(key: 'sunrise')->getNautical()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'sunrise')->getAstronomical());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'sunrise')->getAstronomical()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T03:20:49.000+02:00', actual: $this->data->getSunTimes()->get(key: 'sunrise')->getAstronomical()->format(format: DateTimeInterface::RFC3339_EXTENDED));

        $this->assertInstanceOf(expected: SunTimes::class, actual: $this->data->getSunTimes()->get(key: 'sunset'));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'sunset')->getTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'sunset')->getTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T20:24:08.000+02:00', actual: $this->data->getSunTimes()->get(key: 'sunset')->getTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'sunset')->getCivil());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'sunset')->getCivil()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T21:04:27.000+02:00', actual: $this->data->getSunTimes()->get(key: 'sunset')->getCivil()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'sunset')->getNautical());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'sunset')->getNautical()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T21:56:28.000+02:00', actual: $this->data->getSunTimes()->get(key: 'sunset')->getNautical()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getSunTimes()->get(key: 'sunset')->getAstronomical());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getSunTimes()->get(key: 'sunset')->getAstronomical()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T23:00:19.000+02:00', actual: $this->data->getSunTimes()->get(key: 'sunset')->getAstronomical()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test temperature measurement.
     *
     * @return void
     */
    public function testTemperature(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getTemperature());
        $this->assertEquals(expected: ['min', 'max'], actual: $this->data->getTemperature()->keys()->toArray());

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->data->getTemperature()->get(key: 'min'));
        $this->assertIsFloat(actual: $this->data->getTemperature()->get(key: 'min')->getValue());
        $this->assertEquals(expected: 16.24, actual: $this->data->getTemperature()->get(key: 'min')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getTemperature()->get(key: 'min')->getUnit());
        $this->assertEquals(expected: '16.24 °C', actual: (string) $this->data->getTemperature()->get(key: 'min'));

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->data->getTemperature()->get(key: 'max'));
        $this->assertIsFloat(actual: $this->data->getTemperature()->get(key: 'max')->getValue());
        $this->assertEquals(expected: 24.3, actual: $this->data->getTemperature()->get(key: 'max')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getTemperature()->get(key: 'max')->getUnit());
        $this->assertEquals(expected: '24.3 °C', actual: (string) $this->data->getTemperature()->get(key: 'max'));
    }
}
