<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Support\Conversions;

use Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion;
use Rugaard\WeatherKit\Units\Temperature\Celsius;
use Rugaard\WeatherKit\Units\Temperature\Fahrenheit;
use Rugaard\WeatherKit\Units\Temperature\Kelvin;

/**
 * Trait Temperature.
 *
 * @package Rugaard\WeatherKit\Support\Conversions
 */
trait Temperature
{
    /**
     * Convert from "celsius".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromCelsius(string $to, int|float $value): int|float
    {
        return match ($to) {
            Fahrenheit::class => ($value * 1.8) + 32,
            Kelvin::class => $value + 273.15,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "fahrenheit".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromFahrenheit(string $to, int|float $value): int|float
    {
        return match ($to) {
            Celsius::class => ($value - 32) / 1.8,
            Kelvin::class => ($value - 32) * 5 / 9 + 273.15,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "kelvin".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromKelvin(string $to, int|float $value): int|float
    {
        return match ($to) {
            Celsius::class => $value - 273.15,
            Fahrenheit::class => ($value - 273.15) * 9 / 5 + 32,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert temperature value from one unit to another.
     *
     * @param int|float $value
     * @param string $fromUnit
     * @param string $toUnit
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    protected function convertTemperatureValue(int|float $value, string $fromUnit, string $toUnit): int|float
    {
        if ($fromUnit === $toUnit) {
            return $value;
        }

        return match ($fromUnit) {
            Celsius::class => $this->convertFromCelsius(to: $toUnit, value: $value),
            Fahrenheit::class => $this->convertFromFahrenheit(to: $toUnit, value: $value),
            Kelvin::class => $this->convertFromKelvin(to: $toUnit, value: $value),
            default => $value
        };
    }
}
