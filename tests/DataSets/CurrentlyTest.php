<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DataSets;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\Client;
use Rugaard\WeatherKit\DataSets\Currently;
use Rugaard\WeatherKit\DTO\Coordinate;
use Rugaard\WeatherKit\DTO\Measurements\CloudCover;
use Rugaard\WeatherKit\DTO\Measurements\Direction;
use Rugaard\WeatherKit\DTO\Measurements\Humidity;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\Measurements\Pressure;
use Rugaard\WeatherKit\DTO\Measurements\Temperature;
use Rugaard\WeatherKit\DTO\Measurements\Visibility;
use Rugaard\WeatherKit\DTO\Measurements\Wind;
use Rugaard\WeatherKit\DTO\Provider;
use Rugaard\WeatherKit\Enums\Pressure as PressureTrend;
use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Exceptions\MissingCoordinateException;
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
 * CurrentlyTest.
 *
 * @package Rugaard\WeatherKit\Tests\DataSets
 */
class CurrentlyTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Currently forecast data.
     *
     * @var \Rugaard\WeatherKit\DataSets\Currently
     */
    protected Currently $data;

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
        $this->data = $this->client->setClient(client: $this->mockForecastRequest())->currently();
    }

    /**
     * Test currently request without a location.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testAvailabilityWithoutLocation(): void
    {
        $this->expectException(exception: MissingCoordinateException::class);
        (new Client(token: 'MockedToken'))->currently();
    }

    /**
     * Test data instance.
     *
     * @return void
     */
    public function testDataInstance(): void
    {
        $this->assertInstanceOf(expected: Currently::class, actual: $this->data);
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
        $this->assertIsString($coordinate);
        $this->assertEquals(expected: '55.674,12.568', actual: $coordinate);
    }

    /**
     * Test provider.
     *
     * @return void
     */
    public function testProvider(): void
    {
        $this->assertInstanceOf(expected: Provider::class, actual: $this->data->getProvider());
        $this->assertEquals(expected: 'Mocked Weather Service', actual: $this->data->getProvider()->getName());
        $this->assertNull($this->data->getProvider()->getLogoUrl());
        $this->assertFalse($this->data->getProvider()->getIsUnavailable());
    }



    /**
     * Test legal URL.
     *
     * @return void
     */
    public function testLegalUrl(): void
    {
        $this->assertIsString($this->data->getLegalUrl());
        $this->assertEquals(expected: 'https://weatherkit.apple.com/legal-attribution.html', actual: $this->data->getLegalUrl());
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
        $this->assertEquals(expected: '2022-08-24T18:40:03.000+02:00', actual: $this->data->getExpireTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
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
        $this->assertInstanceOf(expected: CloudCover::class, actual: $this->data->getCloudCover());
        $this->assertIsFloat(actual: $this->data->getCloudCover()->getValue());
        $this->assertEquals(expected: 1.0, actual: $this->data->getCloudCover()->getValue());
        $this->assertInstanceOf(expected: Percentage::class, actual: $this->data->getCloudCover()->getUnit());
        $this->assertEquals(expected: '1%', actual: (string) $this->data->getCloudCover());
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
        $this->assertEquals(expected: 'Clear', actual: $this->data->getCondition()->name);
        $this->assertEquals(expected: 'Clear', actual: $this->data->getCondition()->value);
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
     * Test forecast time measurement.
     *
     * @return void
     */
    public function testForecastTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getForecastTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getForecastTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T18:35:03.000+02:00', actual: $this->data->getForecastTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test isDaylight measurement.
     *
     * @return void
     */
    public function testGetDaylight(): void
    {
        $this->assertIsBool(actual: $this->data->getDaylight());
        $this->assertTrue(condition: $this->data->getDaylight());
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
        $this->assertEquals(expected: 64.0, actual: $this->data->getHumidity()->getValue());
        $this->assertInstanceOf(expected: Percentage::class, actual: $this->data->getHumidity()->getUnit());
        $this->assertEquals(expected: '64%', actual: (string) $this->data->getHumidity());
    }

    /**
     * Test precipitation.
     *
     * @return void
     */
    public function testPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation());
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->data->getPrecipitation());
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
        $this->assertEquals(expected: 1022.63, actual: $this->data->getPressure()->getValue());
        $this->assertInstanceOf(expected: Millibar::class, actual: $this->data->getPressure()->getUnit());
        $this->assertEquals(expected: '1022.63 mbar', actual: (string) $this->data->getPressure());
        $this->assertInstanceOf(expected: PressureTrend::class, actual: $this->data->getPressure()->getTrend());
        $this->assertEquals(expected: 'Falling', actual: $this->data->getPressure()->getTrend()->name);
        $this->assertEquals(expected: 'falling', actual: $this->data->getPressure()->getTrend()->value);
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
        $this->assertEquals(expected: 22.71, actual: $this->data->getTemperature()->get('value')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getTemperature()->get('value')->getUnit());
        $this->assertEquals(expected: '22.71 °C', actual: (string) $this->data->getTemperature()->get('value'));

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->data->getTemperature()->get('apparent'));
        $this->assertIsFloat(actual: $this->data->getTemperature()->get('apparent')->getValue());
        $this->assertEquals(expected: 23.04, actual: $this->data->getTemperature()->get('apparent')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getTemperature()->get('apparent')->getUnit());
        $this->assertEquals(expected: '23.04 °C', actual: (string) $this->data->getTemperature()->get('apparent'));

        $this->assertInstanceOf(expected: Temperature::class, actual: $this->data->getTemperature()->get('dewPoint'));
        $this->assertIsFloat(actual: $this->data->getTemperature()->get('dewPoint')->getValue());
        $this->assertEquals(expected: 15.5, actual: $this->data->getTemperature()->get('dewPoint')->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getTemperature()->get('dewPoint')->getUnit());
        $this->assertEquals(expected: '15.5 °C', actual: (string) $this->data->getTemperature()->get('dewPoint'));
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
        $this->assertEquals(expected: 28621.78, actual: $this->data->getVisibility()->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $this->data->getVisibility()->getUnit());
        $this->assertEquals(expected: '28621.78 m', actual: (string) $this->data->getVisibility());
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
        $this->assertEquals(expected: 11.07, actual: $this->data->getWind()->get('speed')->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $this->data->getWind()->get('speed')->getUnit());
        $this->assertEquals(expected: '11.07 km/h', actual: (string) $this->data->getWind()->get('speed'));

        $this->assertInstanceOf(expected: Wind::class, actual: $this->data->getWind()->get('gust'));
        $this->assertIsFloat(actual: $this->data->getWind()->get('gust')->getValue());
        $this->assertEquals(expected: 20.74, actual: $this->data->getWind()->get('gust')->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $this->data->getWind()->get('gust')->getUnit());
        $this->assertEquals(expected: '20.74 km/h', actual: (string) $this->data->getWind()->get('gust'));

        $this->assertInstanceOf(expected: Direction::class, actual: $this->data->getWind()->get('direction'));
        $this->assertIsInt(actual: $this->data->getWind()->get('direction')->getValue());
        $this->assertEquals(expected: 186, actual: $this->data->getWind()->get('direction')->getValue());
        $this->assertEquals(expected: 'South', actual: $this->data->getWind()->get('direction')->asText());
        $this->assertEquals(expected: 'S', actual: $this->data->getWind()->get('direction')->asAbbreviation());
        $this->assertInstanceOf(expected: Bearing::class, actual: $this->data->getWind()->get('direction')->getUnit());
        $this->assertEquals(expected: '186°', actual: (string) $this->data->getWind()->get('direction'));
    }
}
