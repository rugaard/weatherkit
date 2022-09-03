<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * UVIndexTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class UVIndexTest extends AbstractTestCase
{
    /**
     * Test Low index.
     *
     * @return void
     */
    public function testLow(): void
    {
        $data = UVIndex::from(value: 1);

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'One', actual: $data->name);
        $this->assertIsInt(actual: $data->value);
        $this->assertEquals(expected: 1, actual: $data->value);

        $this->assertIsString(actual: $data->level());
        $this->assertEquals(expected: 'Low', actual: $data->level());

        $this->assertIsString(actual: $data->colorName());
        $this->assertEquals(expected: 'green', actual: $data->colorName());

        $this->assertIsString(actual: $data->colorAsHex());
        $this->assertEquals(expected: '#7bb733', actual: $data->colorAsHex());

        $this->assertIsString(actual: $data->colorAsRGB());
        $this->assertEquals(expected: 'rgb(123, 183, 51)', actual: $data->colorAsRGB());
    }

    /**
     * Test Moderate index.
     *
     * @return void
     */
    public function testModerate(): void
    {
        $data = UVIndex::from(value: 3);

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Three', actual: $data->name);
        $this->assertIsInt(actual: $data->value);
        $this->assertEquals(expected: 3, actual: $data->value);

        $this->assertIsString(actual: $data->level());
        $this->assertEquals(expected: 'Moderate', actual: $data->level());

        $this->assertIsString(actual: $data->colorName());
        $this->assertEquals(expected: 'yellow', actual: $data->colorName());

        $this->assertIsString(actual: $data->colorAsHex());
        $this->assertEquals(expected: '#f7b308', actual: $data->colorAsHex());

        $this->assertIsString(actual: $data->colorAsRGB());
        $this->assertEquals(expected: 'rgb(247, 179, 8)', actual: $data->colorAsRGB());
    }

    /**
     * Test High index.
     *
     * @return void
     */
    public function testHigh(): void
    {
        $data = UVIndex::from(value: 6);

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Six', actual: $data->name);
        $this->assertIsInt(actual: $data->value);
        $this->assertEquals(expected: 6, actual: $data->value);

        $this->assertIsString(actual: $data->level());
        $this->assertEquals(expected: 'High', actual: $data->level());

        $this->assertIsString(actual: $data->colorName());
        $this->assertEquals(expected: 'orange', actual: $data->colorName());

        $this->assertIsString(actual: $data->colorAsHex());
        $this->assertEquals(expected: '#ee8615', actual: $data->colorAsHex());

        $this->assertIsString(actual: $data->colorAsRGB());
        $this->assertEquals(expected: 'rgb(238, 134, 21)', actual: $data->colorAsRGB());
    }

    /**
     * Test Very high index.
     *
     * @return void
     */
    public function testVeryHigh(): void
    {
        $data = UVIndex::from(value: 8);

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Eight', actual: $data->name);
        $this->assertIsInt(actual: $data->value);
        $this->assertEquals(expected: 8, actual: $data->value);

        $this->assertIsString(actual: $data->level());
        $this->assertEquals(expected: 'Very high', actual: $data->level());

        $this->assertIsString(actual: $data->colorName());
        $this->assertEquals(expected: 'red', actual: $data->colorName());

        $this->assertIsString(actual: $data->colorAsHex());
        $this->assertEquals(expected: '#e04028', actual: $data->colorAsHex());

        $this->assertIsString(actual: $data->colorAsRGB());
        $this->assertEquals(expected: 'rgb(224, 64, 40)', actual: $data->colorAsRGB());
    }

    /**
     * Test Extreme index.
     *
     * @return void
     */
    public function testExtreme(): void
    {
        $data = UVIndex::from(value: 11);

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Eleven', actual: $data->name);
        $this->assertIsInt(actual: $data->value);
        $this->assertEquals(expected: 11, actual: $data->value);

        $this->assertIsString(actual: $data->level());
        $this->assertEquals(expected: 'Extreme', actual: $data->level());

        $this->assertIsString(actual: $data->colorName());
        $this->assertEquals(expected: 'violet', actual: $data->colorName());

        $this->assertIsString(actual: $data->colorAsHex());
        $this->assertEquals(expected: '#a85d98', actual: $data->colorAsHex());

        $this->assertIsString(actual: $data->colorAsRGB());
        $this->assertEquals(expected: 'rgb(168, 93, 152)', actual: $data->colorAsRGB());
    }
}
