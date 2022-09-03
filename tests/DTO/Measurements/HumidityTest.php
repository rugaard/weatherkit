<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Measurements;

use Rugaard\WeatherKit\DTO\Measurements\Humidity;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Units\Percentage;

/**
 * HumidityTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Measurements
 */
class HumidityTest extends AbstractTestCase
{
    /**
     * Humidity measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\Humidity
     */
    protected Humidity $data;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new Humidity(data: ['value' => 0.69]);
    }

    /**
     * Test value.
     *
     * @return void
     */
    public function testValue(): void
    {
        $this->assertIsFloat(actual: $this->data->getValue());
        $this->assertEquals(expected: 69.0, actual: $this->data->getValue());
    }

    /**
     * Test unit.
     *
     * @return void
     */
    public function testUnit(): void
    {
        $this->assertInstanceOf(expected: Percentage::class, actual: $this->data->getUnit());
    }
}
