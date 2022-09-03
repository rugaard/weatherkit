<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Forecasts;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Minute;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;
use Rugaard\WeatherKit\Units\Length\Millimeter;

/**
 * MinuteTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Forecasts
 */
class MinuteTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Minute data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Minute
     */
    protected Minute $data;

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
        $this->data = $this->client->setClient(client: $this->mockForecastRequest())->nextHour()->getData()->first();
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
        $this->assertEquals(expected: '2022-08-24T14:09:00.000+02:00', actual: $this->data->getForecastTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test precipitation minute forecast.
     *
     * @return void
     */
    public function testPrecipitation(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getPrecipitation());
        $this->assertEquals(expected: ['chance', 'intensity'], actual: $this->data->getPrecipitation()->keys()->toArray());

        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('chance'));
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('chance'));

        $this->assertInstanceOf(expected: Precipitation::class, actual: $this->data->getPrecipitation()->get('intensity'));
        $this->assertIsFloat(actual: $this->data->getPrecipitation()->get('intensity')->getValue());
        $this->assertEquals(expected: 0.0, actual: $this->data->getPrecipitation()->get('intensity')->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getPrecipitation()->get('intensity')->getUnit());
        $this->assertEquals(expected: '0 mm', actual: (string) $this->data->getPrecipitation()->get('intensity'));
    }
}
