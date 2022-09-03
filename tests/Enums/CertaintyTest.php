<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\Certainty;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * CertaintyTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enumss
 */
class CertaintyTest extends AbstractTestCase
{
    /**
     * Test Likely value.
     *
     * @return void
     */
    public function testLikely(): void
    {
        $data = Certainty::from(value: 'likely');

        $this->assertEquals(expected: 'Likely', actual: $data->name);
        $this->assertEquals(expected: 'likely', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The event is likely to occur (greater than 50% probability)', actual: $data->description());
    }

    /**
     * Test Observed value.
     *
     * @return void
     */
    public function testObserved(): void
    {
        $data = Certainty::from(value: 'observed');

        $this->assertEquals(expected: 'Observed', actual: $data->name);
        $this->assertEquals(expected: 'observed', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The event has already occurred or is ongoing', actual: $data->description());
    }

    /**
     * Test Possible value.
     *
     * @return void
     */
    public function testPossible(): void
    {
        $data = Certainty::from(value: 'possible');

        $this->assertEquals(expected: 'Possible', actual: $data->name);
        $this->assertEquals(expected: 'possible', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The event is unlikely to occur (less than 50% probability)', actual: $data->description());
    }

    /**
     * Test Unknown value.
     *
     * @return void
     */
    public function testUnknown(): void
    {
        $data = Certainty::from(value: 'unknown');

        $this->assertEquals(expected: 'Unknown', actual: $data->name);
        $this->assertEquals(expected: 'unknown', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Unknown if the event will occur', actual: $data->description());
    }

    /**
     * Test Unlikely value.
     *
     * @return void
     */
    public function testUnlikely(): void
    {
        $data = Certainty::from(value: 'unlikely');

        $this->assertEquals(expected: 'Unlikely', actual: $data->name);
        $this->assertEquals(expected: 'unlikely', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The event is not expected to occur (approximately 0% probability)', actual: $data->description());
    }
}
