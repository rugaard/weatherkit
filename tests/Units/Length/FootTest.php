<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Units\Length;

use Rugaard\WeatherKit\Contracts\Unit;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Units\Length\Foot;

/**
 * FootTest.
 *
 * @package Rugaard\WeatherKit\Tests\Units
 */
class FootTest extends AbstractTestCase
{
    /**
     * Unit instance.
     *
     * @var \Rugaard\WeatherKit\Contracts\Unit
     */
    protected Unit $unit;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->unit = new Foot;
    }

    /**
     * Test unit name.
     *
     * @return void
     */
    public function testName(): void
    {
        $this->assertIsString(actual: $this->unit->getName());
        $this->assertEquals(expected: 'Foot', actual: $this->unit->getName());
    }

    /**
     * Test unit abbreviation.
     *
     * @return void
     */
    public function testAbbreviation(): void
    {
        $this->assertIsString(actual: $this->unit->getAbbreviation());
        $this->assertEquals(expected: 'ft', actual: $this->unit->getAbbreviation());
    }

    /**
     * Test unit __toString.
     *
     * @return void
     */
    public function testToString(): void
    {
        $this->assertIsString(actual: (string) $this->unit);
        $this->assertEquals(expected: 'ft', actual: (string) $this->unit);
    }
}
