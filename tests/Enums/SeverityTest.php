<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\Severity;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * SeverityTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class SeverityTest extends AbstractTestCase
{
    /**
     * Test Extreme value.
     *
     * @return void
     */
    public function testExtreme(): void
    {
        $data = Severity::from(value: 'extreme');

        $this->assertEquals(expected: 'Extreme', actual: $data->name);
        $this->assertEquals(expected: 'extreme', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Extraordinary threat', actual: $data->description());
    }

    /**
     * Test Minor value.
     *
     * @return void
     */
    public function testMinor(): void
    {
        $data = Severity::from(value: 'minor');

        $this->assertEquals(expected: 'Minor', actual: $data->name);
        $this->assertEquals(expected: 'minor', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Minimal or no known threat', actual: $data->description());
    }

    /**
     * Test Moderate value.
     *
     * @return void
     */
    public function testModerate(): void
    {
        $data = Severity::from(value: 'moderate');

        $this->assertEquals(expected: 'Moderate', actual: $data->name);
        $this->assertEquals(expected: 'moderate', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Possible threat', actual: $data->description());
    }

    /**
     * Test Severe value.
     *
     * @return void
     */
    public function testSevere(): void
    {
        $data = Severity::from(value: 'severe');

        $this->assertEquals(expected: 'Severe', actual: $data->name);
        $this->assertEquals(expected: 'severe', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Significant threat', actual: $data->description());
    }

    /**
     * Test Unknown value.
     *
     * @return void
     */
    public function testUnknown(): void
    {
        $data = Severity::from(value: 'unknown');

        $this->assertEquals(expected: 'Unknown', actual: $data->name);
        $this->assertEquals(expected: 'unknown', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Unknown threat', actual: $data->description());
    }
}
