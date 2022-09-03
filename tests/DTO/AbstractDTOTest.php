<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO;

use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Day;
use Rugaard\WeatherKit\DTO\SunTimes;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;

/**
 * AbstractDTO.
 *
 * @package Rugaard\WeatherKit\Tests\DTO
 */
class AbstractDTOTest extends AbstractTestCase
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
     * Test toArray.
     *
     * @return void
     */
    public function testToArray(): void
    {
        // Convert data to array.
        $data = $this->data->toArray();

        $this->assertIsArray($data);
        $this->assertArrayNotHasKey(key: 'timezone', array: $data);
        $this->assertArrayHasKey(key: 'condition', array: $data);
        $this->assertInstanceOf(expected: WeatherCondition::class, actual: $data['condition']);
        $this->assertArrayHasKey(key: 'forecasts', array: $data);
        $this->assertInstanceOf(expected: Collection::class, actual: $data['forecasts']);
        $this->assertArrayHasKey(key: 'forecastTime', array: $data);
        $this->assertIsArray(actual: $data['forecastTime']);
        $this->assertArrayHasKey(key: 'maxUVIndex', array: $data);
        $this->assertInstanceOf(expected: UVIndex::class, actual: $data['maxUVIndex']);
        $this->assertArrayHasKey(key: 'moon', array: $data);
        $this->assertIsArray(actual: $data['moon']);
        $this->assertEquals(expected: ['moonrise', 'moonset', 'phase'], actual: array_keys($data['moon']));
        $this->assertArrayHasKey(key: 'precipitation', array: $data);
        $this->assertInstanceOf(expected: Collection::class, actual: $data['precipitation']);
        $this->assertArrayHasKey(key: 'sunTimes', array: $data);
        $this->assertInstanceOf(expected: Collection::class, actual: $data['sunTimes']);
        $this->assertArrayHasKey(key: 'temperature', array: $data);
        $this->assertInstanceOf(expected: Collection::class, actual: $data['temperature']);
    }
}
