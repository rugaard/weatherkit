<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\Moon;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * MoonTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class MoonTest extends AbstractTestCase
{
    /**
     * Test New value.
     *
     * @return void
     */
    public function testNew(): void
    {
        $data = Moon::from(value: 'new');

        $this->assertEquals(expected: 'New', actual: $data->name);
        $this->assertEquals(expected: 'new', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The moon isn’t visible', actual: $data->description());
    }

    /**
     * Test Full value.
     *
     * @return void
     */
    public function testFull(): void
    {
        $data = Moon::from(value: 'full');

        $this->assertEquals(expected: 'Full', actual: $data->name);
        $this->assertEquals(expected: 'full', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The entire disc of the moon is visible', actual: $data->description());
    }

    /**
     * Test FirstQuarter value.
     *
     * @return void
     */
    public function testFirstQuarter(): void
    {
        $data = Moon::from(value: 'firstQuarter');

        $this->assertEquals(expected: 'FirstQuarter', actual: $data->name);
        $this->assertEquals(expected: 'firstQuarter', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Approximately half of the moon is visible, and increasing in size', actual: $data->description());
    }

    /**
     * Test ThirdQuarter value.
     *
     * @return void
     */
    public function testThirdQuarter(): void
    {
        $data = Moon::from(value: 'thirdQuarter');

        $this->assertEquals(expected: 'ThirdQuarter', actual: $data->name);
        $this->assertEquals(expected: 'thirdQuarter', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Approximately half of the moon is visible, and decreasing in size', actual: $data->description());
    }

    /**
     * Test WaningCrescent value.
     *
     * @return void
     */
    public function testWaningCrescent(): void
    {
        $data = Moon::from(value: 'waningCrescent');

        $this->assertEquals(expected: 'WaningCrescent', actual: $data->name);
        $this->assertEquals(expected: 'waningCrescent', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'A crescent-shaped sliver of the moon is visible, and decreasing in size', actual: $data->description());
    }

    /**
     * Test WaningGibbous value.
     *
     * @return void
     */
    public function testWaningGibbous(): void
    {
        $data = Moon::from(value: 'waningGibbous');

        $this->assertEquals(expected: 'WaningGibbous', actual: $data->name);
        $this->assertEquals(expected: 'waningGibbous', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'More than half of the moon is visible, and decreasing in size', actual: $data->description());
    }

    /**
     * Test WaxingCrescent value.
     *
     * @return void
     */
    public function testWaxingCrescent(): void
    {
        $data = Moon::from(value: 'waxingCrescent');

        $this->assertEquals(expected: 'WaxingCrescent', actual: $data->name);
        $this->assertEquals(expected: 'waxingCrescent', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'A crescent-shaped sliver of the moon is visible, and increasing in size', actual: $data->description());
    }

    /**
     * Test WaxingGibbous value.
     *
     * @return void
     */
    public function testWaxingGibbous(): void
    {
        $data = Moon::from(value: 'waxingGibbous');

        $this->assertEquals(expected: 'WaxingGibbous', actual: $data->name);
        $this->assertEquals(expected: 'waxingGibbous', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'More than half of the moon is visible, and increasing in size', actual: $data->description());
    }
}
