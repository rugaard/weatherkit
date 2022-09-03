<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\Importance;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * ImportanceTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class ImportanceTest extends AbstractTestCase
{
    /**
     * Test Low value.
     *
     * @return void
     */
    public function testLow(): void
    {
        $data = Importance::from(value: 'low');

        $this->assertEquals(expected: 'Low', actual: $data->name);
        $this->assertEquals(expected: 'low', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Low importance', actual: $data->description());
    }

    /**
     * Test Normal value.
     *
     * @return void
     */
    public function testNormal(): void
    {
        $data = Importance::from(value: 'normal');

        $this->assertEquals(expected: 'Normal', actual: $data->name);
        $this->assertEquals(expected: 'normal', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Normal importance', actual: $data->description());
    }

    /**
     * Test High value.
     *
     * @return void
     */
    public function testHigh(): void
    {
        $data = Importance::from(value: 'high');

        $this->assertEquals(expected: 'High', actual: $data->name);
        $this->assertEquals(expected: 'high', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'High importance', actual: $data->description());
    }
}
