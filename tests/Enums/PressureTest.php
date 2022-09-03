<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\Pressure;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * PressureTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class PressureTest extends AbstractTestCase
{
    /**
     * Test Falling value.
     *
     * @return void
     */
    public function testFalling(): void
    {
        $data = Pressure::from(value: 'falling');

        $this->assertEquals(expected: 'Falling', actual: $data->name);
        $this->assertEquals(expected: 'falling', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The sea level air pressure is decreasing', actual: $data->description());
    }

    /**
     * Test Rising value.
     *
     * @return void
     */
    public function testRising(): void
    {
        $data = Pressure::from(value: 'rising');

        $this->assertEquals(expected: 'Rising', actual: $data->name);
        $this->assertEquals(expected: 'rising', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The sea level air pressure is increasing', actual: $data->description());
    }

    /**
     * Test Steady value.
     *
     * @return void
     */
    public function testSteady(): void
    {
        $data = Pressure::from(value: 'steady');

        $this->assertEquals(expected: 'Steady', actual: $data->name);
        $this->assertEquals(expected: 'steady', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The sea level air pressure is remaining about the same', actual: $data->description());
    }
}
