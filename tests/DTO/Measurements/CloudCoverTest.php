<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Measurements;

use Rugaard\WeatherKit\DTO\Measurements\CloudCover;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Units\Percentage;

/**
 * CloudCoverTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Measurements
 */
class CloudCoverTest extends AbstractTestCase
{
    /**
     * Cloud cover measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\CloudCover
     */
    protected CloudCover $data;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new CloudCover(data: ['value' => 0.31]);
    }

    /**
     * Test value.
     *
     * @return void
     */
    public function testValue(): void
    {
        $this->assertIsFloat(actual: $this->data->getValue());
        $this->assertEquals(expected: 31.0, actual: $this->data->getValue());
    }

    /**
     * Test unit.
     *
     * @return void
     */
    public function testUnit(): void
    {
        $this->assertInstanceOf(expected: Percentage::class, actual: $this->data->getUnit());
    }
}
