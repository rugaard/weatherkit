<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Measurements;

use Rugaard\WeatherKit\DTO\Measurements\Direction;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Units\Bearing;

/**
 * DirectionTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Measurements
 */
class DirectionTest extends AbstractTestCase
{
    /**
     * Direction measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\Direction
     */
    protected Direction $data;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new Direction(data: ['value' => 128]);
    }

    /**
     * Test value.
     *
     * @return void
     */
    public function testValue(): void
    {
        $this->assertIsInt(actual: $this->data->getValue());
        $this->assertEquals(expected: 128, actual: $this->data->getValue());
    }

    /**
     * Test North direction.
     *
     * @return void
     */
    public function testNorth(): void
    {
        $direction = new Direction(data: ['value' => 0]);

        $this->assertEquals(expected: 'North', actual: $direction->asText());
        $this->assertEquals(expected: 'N', actual: $direction->asAbbreviation());
    }

    /**
     * Test North North-East direction.
     *
     * @return void
     */
    public function testNorthNorthEast(): void
    {
        $direction = new Direction(data: ['value' => 25]);

        $this->assertEquals(expected: 'North North-East', actual: $direction->asText());
        $this->assertEquals(expected: 'NNE', actual: $direction->asAbbreviation());
    }

    /**
     * Test North-East direction.
     *
     * @return void
     */
    public function testNorthEast(): void
    {
        $direction = new Direction(data: ['value' => 50]);

        $this->assertEquals(expected: 'North-East', actual: $direction->asText());
        $this->assertEquals(expected: 'NE', actual: $direction->asAbbreviation());
    }

    /**
     * Test East North-East direction.
     *
     * @return void
     */
    public function testEastNorthEast(): void
    {
        $direction = new Direction(data: ['value' => 75]);

        $this->assertEquals(expected: 'East North-East', actual: $direction->asText());
        $this->assertEquals(expected: 'ENE', actual: $direction->asAbbreviation());
    }

    /**
     * Test East direction.
     *
     * @return void
     */
    public function testEast(): void
    {
        $direction = new Direction(data: ['value' => 100]);

        $this->assertEquals(expected: 'East', actual: $direction->asText());
        $this->assertEquals(expected: 'E', actual: $direction->asAbbreviation());
    }

    /**
     * Test East South-East direction.
     *
     * @return void
     */
    public function testEastSouthEast(): void
    {
        $direction = new Direction(data: ['value' => 120]);

        $this->assertEquals(expected: 'East South-East', actual: $direction->asText());
        $this->assertEquals(expected: 'ESE', actual: $direction->asAbbreviation());
    }

    /**
     * Test South-East direction.
     *
     * @return void
     */
    public function testSouthEast(): void
    {
        $direction = new Direction(data: ['value' => 140]);

        $this->assertEquals(expected: 'South-East', actual: $direction->asText());
        $this->assertEquals(expected: 'SE', actual: $direction->asAbbreviation());
    }

    /**
     * Test South South-East direction.
     *
     * @return void
     */
    public function testSouthSouthEast(): void
    {
        $direction = new Direction(data: ['value' => 160]);

        $this->assertEquals(expected: 'South South-East', actual: $direction->asText());
        $this->assertEquals(expected: 'SSE', actual: $direction->asAbbreviation());
    }

    /**
     * Test South direction.
     *
     * @return void
     */
    public function testSouth(): void
    {
        $direction = new Direction(data: ['value' => 180]);

        $this->assertEquals(expected: 'South', actual: $direction->asText());
        $this->assertEquals(expected: 'S', actual: $direction->asAbbreviation());
    }

    /**
     * Test South South-West direction.
     *
     * @return void
     */
    public function testSouthSouthWest(): void
    {
        $direction = new Direction(data: ['value' => 200]);

        $this->assertEquals(expected: 'South South-West', actual: $direction->asText());
        $this->assertEquals(expected: 'SSW', actual: $direction->asAbbreviation());
    }

    /**
     * Test South-West direction.
     *
     * @return void
     */
    public function testSouthWest(): void
    {
        $direction = new Direction(data: ['value' => 220]);

        $this->assertEquals(expected: 'South-West', actual: $direction->asText());
        $this->assertEquals(expected: 'SW', actual: $direction->asAbbreviation());
    }

    /**
     * Test West South-West direction.
     *
     * @return void
     */
    public function testWestSouthWest(): void
    {
        $direction = new Direction(data: ['value' => 240]);

        $this->assertEquals(expected: 'West South-West', actual: $direction->asText());
        $this->assertEquals(expected: 'WSW', actual: $direction->asAbbreviation());
    }

    /**
     * Test West direction.
     *
     * @return void
     */
    public function testWest(): void
    {
        $direction = new Direction(data: ['value' => 260]);

        $this->assertEquals(expected: 'West', actual: $direction->asText());
        $this->assertEquals(expected: 'W', actual: $direction->asAbbreviation());
    }

    /**
     * Test West North-West direction.
     *
     * @return void
     */
    public function testWestNorthWest(): void
    {
        $direction = new Direction(data: ['value' => 290]);

        $this->assertEquals(expected: 'West North-West', actual: $direction->asText());
        $this->assertEquals(expected: 'WNW', actual: $direction->asAbbreviation());
    }

    /**
     * Test North-West direction.
     *
     * @return void
     */
    public function testNorthWest(): void
    {
        $direction = new Direction(data: ['value' => 310]);

        $this->assertEquals(expected: 'North-West', actual: $direction->asText());
        $this->assertEquals(expected: 'NW', actual: $direction->asAbbreviation());
    }

    /**
     * Test North North-West direction.
     *
     * @return void
     */
    public function testNorthNorthWest(): void
    {
        $direction = new Direction(data: ['value' => 340]);

        $this->assertEquals(expected: 'North North-West', actual: $direction->asText());
        $this->assertEquals(expected: 'NNW', actual: $direction->asAbbreviation());
    }

    /**
     * Test unit.
     *
     * @return void
     */
    public function testUnit(): void
    {
        $this->assertInstanceOf(expected: Bearing::class, actual: $this->data->getUnit());
    }
}
