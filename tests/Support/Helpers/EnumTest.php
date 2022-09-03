<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Support\Helpers;

use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use ValueError;

/**
 * Enum.
 *
 * @package Rugaard\WeatherKit\Tests\Support\Helpers
 */
class EnumTest extends AbstractTestCase
{
    /**
     * Test fromName.
     *
     * @return void
     */
    public function testFromName(): void
    {
        $data = WeatherCondition::fromName(case: 'MostlyClear');

        $this->assertEquals(expected: 'MostlyClear', actual: $data->name);
        $this->assertEquals(expected: 'Mostly clear', actual: $data->value);
    }

    /**
     * Test fromName when failing.
     *
     * @return void
     */
    public function testFromNameFailure(): void
    {
        $this->expectException(exception: ValueError::class);
        WeatherCondition::fromName(case: 'MostlyNotClear');
    }

    /**
     * Test tryFromName.
     *
     * @return void
     */
    public function testTryFromName(): void
    {
        $data = WeatherCondition::tryFromName(case: 'MostlyClear');

        $this->assertNotNull(actual: $data);
        $this->assertEquals(expected: 'MostlyClear', actual: $data->name);
        $this->assertEquals(expected: 'Mostly clear', actual: $data->value);
    }

    /**
     * Test tryFromName when failing.
     *
     * @return void
     */
    public function testTryFromNameFailure(): void
    {
        $data = WeatherCondition::tryFromName(case: 'MostlyNotClear');
        $this->assertNull(actual: $data);
    }
}
