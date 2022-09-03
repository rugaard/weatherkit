<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Support\Conversions;

use Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion;
use Rugaard\WeatherKit\Units\Pressure\Bar;
use Rugaard\WeatherKit\Units\Pressure\Hectopascal;
use Rugaard\WeatherKit\Units\Pressure\KilogramForcePerSquareCentimeter;
use Rugaard\WeatherKit\Units\Pressure\KilogramForcePerSquareMeter;
use Rugaard\WeatherKit\Units\Pressure\Millibar;
use Rugaard\WeatherKit\Units\Pressure\Pascal;

/**
 * Trait Pressure.
 *
 * @package Rugaard\WeatherKit\Support\Conversions
 */
trait Pressure
{
    /**
     * Convert from "bar".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromBar(string $to, int|float $value): int|float
    {
        return match ($to) {
            Hectopascal::class, Millibar::class => $value * 1000,
            KilogramForcePerSquareCentimeter::class => $value * 1.019716,
            KilogramForcePerSquareMeter::class => $value * 10197.16213,
            Pascal::class => $value * 100000,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "hectopascal".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromHectopascal(string $to, int|float $value): int|float
    {
        return match ($to) {
            Bar::class => $value / 1000,
            KilogramForcePerSquareCentimeter::class => $value * 0.00102,
            KilogramForcePerSquareMeter::class => $value * 10.197162,
            Pascal::class => $value * 100,
            Millibar::class => $value,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "kilograms per square centimeter".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromKilogramForcePerSquareCentimeter(string $to, int|float $value): int|float
    {
        return match ($to) {
            Bar::class => $value * 0.980665,
            Hectopascal::class, Millibar::class => $value * 980.665,
            KilogramForcePerSquareMeter::class => $value * 10000,
            Pascal::class => $value * 98066.5,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "kilograms per square meter".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromKilogramForcePerSquareMeter(string $to, int|float $value): int|float
    {
        return match ($to) {
            Bar::class => $value * 0.000098067,
            Hectopascal::class, Millibar::class => $value * 0.098067,
            KilogramForcePerSquareCentimeter::class => $value / 10000,
            Pascal::class => $value * 9.80665,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "millibar".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromMillibar(string $to, int|float $value): int|float
    {
        return match ($to) {
            Bar::class => $value / 1000,
            Hectopascal::class => $value,
            KilogramForcePerSquareCentimeter::class => $value * 0.00102,
            KilogramForcePerSquareMeter::class => $value * 10.197162,
            Pascal::class => $value * 100,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "pascal".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromPascal(string $to, int|float $value): int|float
    {
        return match ($to) {
            Bar::class => $value / 100000,
            Hectopascal::class, Millibar::class => $value / 100,
            KilogramForcePerSquareCentimeter::class => $value * 0.000010197,
            KilogramForcePerSquareMeter::class => $value * 0.101972,
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
    protected function convertPressureValue(int|float $value, string $fromUnit, string $toUnit): int|float
    {
        if ($fromUnit === $toUnit) {
            return $value;
        }

        return match ($fromUnit) {
            Bar::class => $this->convertFromBar(to: $toUnit, value: $value),
            Hectopascal::class => $this->convertFromHectopascal(to: $toUnit, value: $value),
            KilogramForcePerSquareCentimeter::class => $this->convertFromKilogramForcePerSquareCentimeter(to: $toUnit, value: $value),
            KilogramForcePerSquareMeter::class => $this->convertFromKilogramForcePerSquareMeter(to: $toUnit, value: $value),
            Millibar::class => $this->convertFromMillibar(to: $toUnit, value: $value),
            Pascal::class => $this->convertFromPascal(to: $toUnit, value: $value),
            default => $value
        };
    }
}
