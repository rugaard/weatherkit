<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Forecasts;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Period;
use Rugaard\WeatherKit\DTO\Measurements\CloudCover;
use Rugaard\WeatherKit\DTO\Measurements\Direction;
use Rugaard\WeatherKit\DTO\Measurements\Humidity;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\Measurements\Wind;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Precipitation as PrecipitationType;
use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;
use Rugaard\WeatherKit\Units\Bearing;
use Rugaard\WeatherKit\Units\Length\Millimeter;
use Rugaard\WeatherKit\Units\Percentage;
use Rugaard\WeatherKit\Units\Speed\KilometerPerHour;

/**
 * PeriodTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Forecasts
 */
class PeriodTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Period data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Period
     */
    protected Period $data;

    /**
     * Set up test case.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->data = $this->client->setClient(client: $this->mockForecastRequest())->daily()->getData()->first()->getForecasts()->get(key: 'daytime');
    }

    /**
     * Test cloud cover.
     *
     * @return void
     */
    public function testCloudCover(): void
    {
        $this->assertInstanceOf(expected: CloudCover::class, actual: $this->data->getCloudCover());
        $this->assertIsFloat(actual: $this->data->getCloudCover()->getValue());
        $this->assertEquals(expected: 14.000000000000002, actual: $this->data->getCloudCover()->getValue());
        $this->assertInstanceOf(expected: Percentage::class, actual: $this->data->getCloudCover()->getUnit());
        $this->assertEquals(expected: '14%', actual: (string) $this->data->getCloudCover());
    }

    /**
     * Test weather condition.
     *
     * @return void
     */
    public function testCondition(): void
    {
        $this->assertInstanceOf(expected: WeatherCondition::class, actual: $this->data->getCondition());
        $this->assertEquals(expected: 'MostlyClear', actual: $this->data->getCondition()->name);
        $this->assertEquals(expected: 'Mostly clear', actual: $this->data->getCondition()->value);
    }

    /**
     * Test weather condition.
     *
     * @return void
     */
    public function testForecastTime(): void
    {
        $this->assertInstanceOf(expected: TimePeriod::class, actual: $this->data->getForecastTime());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getForecastTime()->getStart());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getForecastTime()->getStart()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T07:00:00.000+02:00', actual: $this->data->getForecastTime()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getForecastTime()->getEnd());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getForecastTime()->getEnd()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T19:00:00.000+02:00', actual: $this->data->getForecastTime()->getEnd()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test humidity.
     *
     * @return void
     */
    public function testHumidity(): void
    {
        $this->assertInstanceOf(expected: Humidity::class, actual: $this->data->getHumidity());
        $this->assertIsFloat(actual: $this->data->getHumidity()->getValue());
        $this->assertEquals(expected: 61.0, actual: $this->data->getHumidity()->getValue());
        $this->assertInstanceOf(expected: Percentage::class, actual: $this->data->getHumidity()->getUnit());
        $this->assertEquals(expected: '61%', actual: (string) $this->data->getHumidity());
    }

    /**
     * Test precipitation.
     *
     * @return void
     */
    public function testPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getPrecipitation());
        $this->assertEquals(expected: ['type', 'chance', 'amount', 'snowfall'], actual: $this->data->getPrecipitation()->keys()->toArray());

        $this->assertInstanceOf(expected: PrecipitationType::class, actual: $this->data->getPrecipitation()->get('type'));
        $this->assertEquals(expected: 'Clear', actual: $this->data->getPrecipitation()->get('type')->name);
        $this->assertEquals(expected: 'clear', actual: $this->data->getPrecipitation()->get('type')->value);

        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('chance'));
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('chance'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get('amount'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('amount')->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('amount')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get('amount')->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->data->getPrecipitation()->get('amount'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get('snowfall'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('snowfall')->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('snowfall')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get('snowfall')->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->data->getPrecipitation()->get('snowfall'));
    }

    /**
     * Test wind.
     *
     * @return void
     */
    public function testWind(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getWind());
        $this->assertEquals(expected: ['speed', 'direction'], actual: $this->data->getWind()->keys()->toArray());

        $this->assertInstanceOf(expected: Wind::class, actual: $this->data->getWind()->get('speed'));
        $this->assertIsFloat(actual: $this->data->getWind()->get('speed')->getValue());
        $this->assertEquals(expected: 9.08, actual: $this->data->getWind()->get('speed')->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $this->data->getWind()->get('speed')->getUnit());
        $this->assertEquals(expected: '9.08 km/h', actual: (string) $this->data->getWind()->get('speed'));

        $this->assertInstanceOf(expected: Direction::class, actual: $this->data->getWind()->get('direction'));
        $this->assertIsInt(actual: $this->data->getWind()->get('direction')->getValue());
        $this->assertEquals(expected: 121, actual: $this->data->getWind()->get('direction')->getValue());
        $this->assertEquals(expected: 'East South-East', actual: $this->data->getWind()->get('direction')->asText());
        $this->assertEquals(expected: 'ESE', actual: $this->data->getWind()->get('direction')->asAbbreviation());
        $this->assertInstanceOf(expected: Bearing::class, actual: $this->data->getWind()->get('direction')->getUnit());
        $this->assertEquals(expected: '121°', actual: (string) $this->data->getWind()->get('direction'));
    }
}
