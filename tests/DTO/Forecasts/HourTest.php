<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Forecasts;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Hour;
use Rugaard\WeatherKit\DTO\Measurements\CloudCover;
use Rugaard\WeatherKit\DTO\Measurements\Direction;
use Rugaard\WeatherKit\DTO\Measurements\Humidity;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\Measurements\Pressure;
use Rugaard\WeatherKit\DTO\Measurements\Temperature;
use Rugaard\WeatherKit\DTO\Measurements\Visibility;
use Rugaard\WeatherKit\DTO\Measurements\Wind;
use Rugaard\WeatherKit\Enums\Precipitation as PrecipitationType;
use Rugaard\WeatherKit\Enums\Pressure as PressureTrend;
use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;
use Rugaard\WeatherKit\Units\Bearing;
use Rugaard\WeatherKit\Units\Length\Meter;
use Rugaard\WeatherKit\Units\Length\Millimeter;
use Rugaard\WeatherKit\Units\Percentage;
use Rugaard\WeatherKit\Units\Pressure\Millibar;
use Rugaard\WeatherKit\Units\Speed\KilometerPerHour;
use Rugaard\WeatherKit\Units\Temperature\Celsius;

/**
 * HourTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Forecasts
 */
class HourTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Hour data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Hour
     */
    protected Hour $data;

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
        $this->data = $this->client->setClient(client: $this->mockForecastRequest())->hourly()->getData()->first();
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
        $this->assertEquals(expected: 24.0, actual: $this->data->getCloudCover()->getValue());
        $this->assertInstanceOf(expected: Percentage::class, actual: $this->data->getCloudCover()->getUnit());
        $this->assertEquals(expected: '24%', actual: (string) $this->data->getCloudCover());
    }

    /**
     * Test missing cloud cover measurement.
     *
     * @return void
     */
    public function testMissingCloudCover(): void
    {
        $this->data->setCloudCover(cloudCover: null);
        $this->assertNull(actual: $this->data->getCloudCover());
    }

    /**
     * Test weather condition measurement.
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
     * Test invalid weather condition measurement.
     *
     * @return void
     */
    public function testInvalidCondition(): void
    {
        $this->data->setCondition(condition: 'RainbowAndSunshine');
        $this->assertNull(actual: $this->data->getCondition());
    }

    /**
     * Test forecast time.
     *
     * @return void
     */
    public function testForecastTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getForecastTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getForecastTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-23T22:00:00.000+02:00', actual: $this->data->getForecastTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test isDaylight measurement.
     *
     * @return void
     */
    public function testGetDaylight(): void
    {
        $this->assertIsBool(actual: $this->data->getDaylight());
        $this->assertFalse(condition: $this->data->getDaylight());
    }

    /**
     * Test missing isDaylight measurement.
     *
     * @return void
     */
    public function testMissingGetDaylight(): void
    {
        $this->data->setDaylight(isDaylight: null);
        $this->assertNull(actual: $this->data->getDaylight());
    }

    /**
     * Test humidity measurement.
     *
     * @return void
     */
    public function testHumidity(): void
    {
        $this->assertInstanceOf(expected: Humidity::class, actual: $this->data->getHumidity());
        $this->assertIsFloat(actual: $this->data->getHumidity()->getValue());
        $this->assertEquals(expected: 73.0, actual: $this->data->getHumidity()->getValue());
        $this->assertInstanceOf(expected: Percentage::class, actual: $this->data->getHumidity()->getUnit());
        $this->assertEquals(expected: '73%', actual: (string) $this->data->getHumidity());
    }

    /**
     * Test daily precipitation forecast.
     *
     * @return void
     */
    public function testPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getPrecipitation());
        $this->assertEquals(expected: ['type', 'chance', 'intensity', 'amount', 'snowfall'], actual: $this->data->getPrecipitation()->keys()->toArray());

        $this->assertInstanceOf(expected: PrecipitationType::class, actual: $this->data->getPrecipitation()->get('type'));
        $this->assertEquals(expected: 'Snow', actual: $this->data->getPrecipitation()->get('type')->name);
        $this->assertEquals(expected: 'snow', actual: $this->data->getPrecipitation()->get('type')->value);

        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('chance'));
        $this->assertEquals(expected: 91.0, actual: $this->data->getPrecipitation()->get('chance'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get('intensity'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('intensity')->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('intensity')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get('intensity')->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->data->getPrecipitation()->get('intensity'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get('amount'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('amount')->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('amount')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get('amount')->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->data->getPrecipitation()->get('amount'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get('snowfall'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('snowfall')->getValue());
        $this->assertEquals(expected: 0.54, actual: $this->data->getPrecipitation()->get('snowfall')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get('snowfall')->getUnit());
        $this->assertEquals(expected: '0.54 mm', actual: (string) $this->data->getPrecipitation()->get('snowfall'));
    }

    /**
     * Test pressure measurement.
     *
     * @return void
     */
    public function testPressure(): void
    {
        $this->assertInstanceOf(expected: Pressure::class, actual: $this->data->getPressure());
        $this->assertIsFloat(actual: $this->data->getPressure()->getValue());
        $this->assertEquals(expected: 1022.98, actual: $this->data->getPressure()->getValue());
        $this->assertInstanceOf(expected: Millibar::class, actual: $this->data->getPressure()->getUnit());
        $this->assertEquals(expected: '1022.98 mbar', actual: (string) $this->data->getPressure());
        $this->assertInstanceOf(expected: PressureTrend::class, actual: $this->data->getPressure()->getTrend());
        $this->assertEquals(expected: 'Rising', actual: $this->data->getPressure()->getTrend()->name);
        $this->assertEquals(expected: 'rising', actual: $this->data->getPressure()->getTrend()->value);
    }

    /**
     * Test temperature measurement.
     *
     * @return void
     */
    public function testTemperature(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getTemperature());
        $this->assertEquals(expected: ['value', 'apparent', 'dewPoint'], actual: $this->data->getTemperature()->keys()->toArray());

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->data->getTemperature()->get('value'));
        $this->assertIsFloat(actual: $this->data->getTemperature()->get('value')->getValue());
        $this->assertEquals(expected: 19.23, actual: $this->data->getTemperature()->get('value')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getTemperature()->get('value')->getUnit());
        $this->assertEquals(expected: '19.23 °C', actual: (string) $this->data->getTemperature()->get('value'));

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->data->getTemperature()->get('apparent'));
        $this->assertIsFloat(actual: $this->data->getTemperature()->get('apparent')->getValue());
        $this->assertEquals(expected: 19.26, actual: $this->data->getTemperature()->get('apparent')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getTemperature()->get('apparent')->getUnit());
        $this->assertEquals(expected: '19.26 °C', actual: (string) $this->data->getTemperature()->get('apparent'));

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->data->getTemperature()->get('dewPoint'));
        $this->assertIsFloat(actual: $this->data->getTemperature()->get('dewPoint')->getValue());
        $this->assertEquals(expected: 14.18, actual: $this->data->getTemperature()->get('dewPoint')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getTemperature()->get('dewPoint')->getUnit());
        $this->assertEquals(expected: '14.18 °C', actual: (string) $this->data->getTemperature()->get('dewPoint'));
    }

    /**
     * Test UV index measurement.
     *
     * @return void
     */
    public function testUVIndex(): void
    {
        $this->assertInstanceOf(expected: UVIndex::class, actual: $this->data->getUVIndex());
        $this->assertEquals(expected: 'Zero', actual: $this->data->getUVIndex()->name);
        $this->assertEquals(expected: 0, actual: $this->data->getUVIndex()->value);
        $this->assertEquals(expected: 'Low', actual: $this->data->getUVIndex()->level());
        $this->assertEquals(expected: 'green', actual: $this->data->getUVIndex()->colorName());
        $this->assertEquals(expected: '#7bb733', actual: $this->data->getUVIndex()->colorAsHex());
        $this->assertEquals(expected: 'rgb(123, 183, 51)', actual: $this->data->getUVIndex()->colorAsRGB());
    }

    /**
     * Test visibility measurement.
     *
     * @return void
     */
    public function testVisibility(): void
    {
        $this->assertInstanceOf(expected: Visibility::class, actual: $this->data->getVisibility());
        $this->assertIsFloat(actual: $this->data->getVisibility()->getValue());
        $this->assertEquals(expected: 29014.41, actual: $this->data->getVisibility()->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $this->data->getVisibility()->getUnit());
        $this->assertEquals(expected: '29014.41 m', actual: (string) $this->data->getVisibility());
    }

    /**
     * Test wind measurement.
     *
     * @return void
     */
    public function testWind(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getWind());

        $this->assertInstanceOf(expected: Wind::class, actual: $this->data->getWind()->get('speed'));
        $this->assertIsFloat(actual: $this->data->getWind()->get('speed')->getValue());
        $this->assertEquals(expected: 6.81, actual: $this->data->getWind()->get('speed')->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $this->data->getWind()->get('speed')->getUnit());
        $this->assertEquals(expected: '6.81 km/h', actual: (string) $this->data->getWind()->get('speed'));

        $this->assertInstanceOf(expected: Wind::class, actual: $this->data->getWind()->get('gust'));
        $this->assertIsFloat(actual: $this->data->getWind()->get('gust')->getValue());
        $this->assertEquals(expected: 13.71, actual: $this->data->getWind()->get('gust')->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $this->data->getWind()->get('gust')->getUnit());
        $this->assertEquals(expected: '13.71 km/h', actual: (string) $this->data->getWind()->get('gust'));

        $this->assertInstanceOf(expected: Direction::class, actual: $this->data->getWind()->get('direction'));
        $this->assertIsInt($this->data->getWind()->get('direction')->getValue());
        $this->assertEquals(expected: 188, actual: $this->data->getWind()->get('direction')->getValue());
        $this->assertEquals(expected: 'South', actual: $this->data->getWind()->get('direction')->asText());
        $this->assertEquals(expected: 'S', actual: $this->data->getWind()->get('direction')->asAbbreviation());
        $this->assertInstanceOf(expected: Bearing::class, actual: $this->data->getWind()->get('direction')->getUnit());
        $this->assertEquals(expected: '188°', actual: (string) $this->data->getWind()->get('direction'));
    }
}
