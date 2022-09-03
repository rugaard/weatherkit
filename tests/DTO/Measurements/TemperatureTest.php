<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Measurements;

use Rugaard\WeatherKit\DTO\Measurements\Temperature;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Units\Temperature\Celsius;
use Rugaard\WeatherKit\Units\Temperature\Fahrenheit;
use Rugaard\WeatherKit\Units\Temperature\Kelvin;

/**
 * TemperatureTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Measurements
 */
class TemperatureTest extends AbstractTestCase
{
    /**
     * Temperature measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\Temperature
     */
    protected Temperature $data;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new Temperature(data: ['value' => 28.31]);
    }

    /**
     * Test value.
     *
     * @return void
     */
    public function testValue(): void
    {
        $this->assertIsFloat(actual: $this->data->getValue());
        $this->assertEquals(expected: 28.31, actual: $this->data->getValue());
    }

    /**
     * Test unit.
     *
     * @return void
     */
    public function testUnit(): void
    {
        $this->assertInstanceOf(expected: Celsius::class, actual: $this->data->getUnit());
    }

    /**
     * Test __toString.
     *
     * @return void
     */
    public function testToString(): void
    {
        $this->assertEquals(expected: '28.31 °C', actual: (string) $this->data);
    }

    /**
     * Test conversion: celsius to celsius.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCelsiusToCelsius(): void
    {
        $data = (clone $this->data)->asCelsius();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.31 °C', actual: (string) $data);
    }

    /**
     * Test conversion: celsius to fahrenheit.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCelsiusToFahrenheit(): void
    {
        $data = (clone $this->data)->asFahrenheit();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 82.958, actual: $data->getValue());
        $this->assertInstanceOf(expected: Fahrenheit::class, actual: $data->getUnit());
        $this->assertEquals(expected: '82.958 °F', actual: (string) $data);
    }

    /**
     * Test conversion: celsius to kelvin.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCelsiusToKelvin(): void
    {
        $data = (clone $this->data)->asKelvin();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 301.46, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kelvin::class, actual: $data->getUnit());
        $this->assertEquals(expected: '301.46 K', actual: (string) $data);
    }

    /**
     * Test conversion: fahrenheit to celsius.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFahrenheitToCelsius(): void
    {
        $data = (clone $this->data)->asFahrenheit()->asCelsius();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.31 °C', actual: (string) $data);
    }

    /**
     * Test conversion: fahrenheit to kelvin.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFahrenheitToKelvin(): void
    {
        $data = (clone $this->data)->asFahrenheit()->asKelvin();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 301.46, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kelvin::class, actual: $data->getUnit());
        $this->assertEquals(expected: '301.46 K', actual: (string) $data);
    }

    /**
     * Test conversion: kelvin to celsius.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKelvinToCelsius(): void
    {
        $data = (clone $this->data)->asKelvin()->asCelsius();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Celsius::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.31 °C', actual: (string) $data);
    }

    /**
     * Test conversion: kelvin to fahrenheit.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKelvinToFahrenheit(): void
    {
        $data = (clone $this->data)->asKelvin()->asFahrenheit();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 82.958, actual: $data->getValue());
        $this->assertInstanceOf(expected: Fahrenheit::class, actual: $data->getUnit());
        $this->assertEquals(expected: '82.958 °F', actual: (string) $data);
    }
}
