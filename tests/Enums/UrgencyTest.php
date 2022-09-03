<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\Urgency;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * UrgencyTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class UrgencyTest extends AbstractTestCase
{
    /**
     * Test Expected value.
     *
     * @return void
     */
    public function testExpected(): void
    {
        $data = Urgency::from(value: 'expected');

        $this->assertEquals(expected: 'Expected', actual: $data->name);
        $this->assertEquals(expected: 'expected', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Take responsive action in the next hour', actual: $data->description());
    }

    /**
     * Test Future value.
     *
     * @return void
     */
    public function testFuture(): void
    {
        $data = Urgency::from(value: 'future');

        $this->assertEquals(expected: 'Future', actual: $data->name);
        $this->assertEquals(expected: 'future', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Take responsive action in the near future', actual: $data->description());
    }

    /**
     * Test Immediate value.
     *
     * @return void
     */
    public function testImmediate(): void
    {
        $data = Urgency::from(value: 'immediate');

        $this->assertEquals(expected: 'Immediate', actual: $data->name);
        $this->assertEquals(expected: 'immediate', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Take responsive action immediately', actual: $data->description());
    }

    /**
     * Test Past value.
     *
     * @return void
     */
    public function testPast(): void
    {
        $data = Urgency::from(value: 'past');

        $this->assertEquals(expected: 'Past', actual: $data->name);
        $this->assertEquals(expected: 'past', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Responsive action is no longer required', actual: $data->description());
    }

    /**
     * Test Unknown value.
     *
     * @return void
     */
    public function testUnknown(): void
    {
        $data = Urgency::from(value: 'unknown');

        $this->assertEquals(expected: 'Unknown', actual: $data->name);
        $this->assertEquals(expected: 'unknown', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Urgency is unknown', actual: $data->description());
    }
}
