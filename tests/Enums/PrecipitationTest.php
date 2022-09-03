<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\Precipitation;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * PrecipitationTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class PrecipitationTest extends AbstractTestCase
{
    /**
     * Test Clear value.
     *
     * @return void
     */
    public function testClear(): void
    {
        $data = Precipitation::from(value: 'clear');

        $this->assertEquals(expected: 'Clear', actual: $data->name);
        $this->assertEquals(expected: 'clear', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'No precipitation is occurring', actual: $data->description());
    }

    /**
     * Test Hail value.
     *
     * @return void
     */
    public function testHail(): void
    {
        $data = Precipitation::from(value: 'hail');

        $this->assertEquals(expected: 'Hail', actual: $data->name);
        $this->assertEquals(expected: 'hail', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Hail is falling', actual: $data->description());
    }

    /**
     * Test Mixed value.
     *
     * @return void
     */
    public function testMixed(): void
    {
        $data = Precipitation::from(value: 'mixed');

        $this->assertEquals(expected: 'Mixed', actual: $data->name);
        $this->assertEquals(expected: 'mixed', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Winter weather (wintery mix or wintery showers) is falling', actual: $data->description());
    }

    /**
     * Test Rain value.
     *
     * @return void
     */
    public function testRain(): void
    {
        $data = Precipitation::from(value: 'rain');

        $this->assertEquals(expected: 'Rain', actual: $data->name);
        $this->assertEquals(expected: 'rain', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Rain or freezing rain is falling', actual: $data->description());
    }

    /**
     * Test Sleet value.
     *
     * @return void
     */
    public function testSleet(): void
    {
        $data = Precipitation::from(value: 'sleet');

        $this->assertEquals(expected: 'Sleet', actual: $data->name);
        $this->assertEquals(expected: 'sleet', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Sleet or ice pellets are falling', actual: $data->description());
    }

    /**
     * Test Snow value.
     *
     * @return void
     */
    public function testSnow(): void
    {
        $data = Precipitation::from(value: 'snow');

        $this->assertEquals(expected: 'Snow', actual: $data->name);
        $this->assertEquals(expected: 'snow', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Snow is falling', actual: $data->description());
    }

    /**
     * Test Snow value.
     *
     * @return void
     */
    public function testUnknown(): void
    {
        $data = Precipitation::from(value: 'precipitation');

        $this->assertEquals(expected: 'Unknown', actual: $data->name);
        $this->assertEquals(expected: 'precipitation', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'An unknown type of precipitation is occuring', actual: $data->description());
    }
}
