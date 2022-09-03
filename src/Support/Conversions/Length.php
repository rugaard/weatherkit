<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Support\Conversions;

use Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion;
use Rugaard\WeatherKit\Units\Length\Centimeter;
use Rugaard\WeatherKit\Units\Length\Foot;
use Rugaard\WeatherKit\Units\Length\Inch;
use Rugaard\WeatherKit\Units\Length\Kilometer;
use Rugaard\WeatherKit\Units\Length\Meter;
use Rugaard\WeatherKit\Units\Length\Mile;
use Rugaard\WeatherKit\Units\Length\Millimeter;
use Rugaard\WeatherKit\Units\Length\Yard;

/**
 * Trait Length.
 *
 * @package Rugaard\WeatherKit\Support\Conversions
 */
trait Length
{
    /**
     * Convert from "centimeter".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromCentimeter(string $to, int|float $value): int|float
    {
        return match ($to) {
            Foot::class => $value / 30.48,
            Inch::class => $value / 2.54,
            Kilometer::class => $value / 100000,
            Meter::class => $value / 100,
            Mile::class => $value * 0.000000000000062137,
            Millimeter::class => $value * 10,
            Yard::class => $value * 0.010936,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "feet".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromFoot(string $to, int|float $value): int|float
    {
        return match ($to) {
            Centimeter::class => $value * 30.48,
            Inch::class => $value * 12,
            Kilometer::class => $value * 0.000305,
            Meter::class => $value * 0.3048,
            Mile::class => $value / 5280,
            Millimeter::class => $value * 304.8,
            Yard::class => $value / 3,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "inch".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromInch(string $to, int|float $value): int|float
    {
        return match ($to) {
            Centimeter::class => $value * 2.54,
            Foot::class => $value / 12,
            Kilometer::class => $value * 0.0000254,
            Meter::class => $value * 0.0254,
            Mile::class => $value / 63360,
            Millimeter::class => $value * 25.4,
            Yard::class => $value / 36,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "kilometer".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromKilometer(string $to, int|float $value): int|float
    {
        return match ($to) {
            Centimeter::class => $value * 100000,
            Foot::class => $value * 3280.839895,
            Inch::class => $value * 39370.07874,
            Meter::class => $value * 1000,
            Mile::class => $value * 0.621371,
            Millimeter::class => $value / 1000000,
            Yard::class => $value * 1093.613298,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "meter".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromMeter(string $to, int|float $value): int|float
    {
        return match ($to) {
            Centimeter::class => $value * 100,
            Foot::class => $value * 3.28084,
            Inch::class => $value * 39.370079,
            Kilometer::class => $value / 1000,
            Mile::class => $value * 0.000621,
            Millimeter::class => $value * 1000,
            Yard::class => $value * 1.093613,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "miles".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromMile(string $to, int|float $value): int|float
    {
        return match ($to) {
            Centimeter::class => $value * 160934.4,
            Foot::class => $value * 5280,
            Inch::class => $value * 63360,
            Kilometer::class => $value * 1.609344,
            Meter::class => $value * 1609.344,
            Millimeter::class => $value * 1609344,
            Yard::class => $value * 1760,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "millimeter".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromMillimeter(string $to, int|float $value): int|float
    {
        return match ($to) {
            Centimeter::class => $value / 10,
            Foot::class => $value * 0.003281,
            Inch::class => $value / 25.4,
            Kilometer::class => $value / 1000000,
            Meter::class => $value / 1000,
            Mile::class => $value / 1609344,
            Yard::class => $value * 0.001094,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "yard".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromYard(string $to, int|float $value): int|float
    {
        return match ($to) {
            Centimeter::class => $value * 91.44,
            Foot::class => $value * 3,
            Inch::class => $value * 36,
            Kilometer::class => $value * 0.000914,
            Meter::class => $value * 0.9144,
            Mile::class => $value / 1760,
            Millimeter::class => $value * 914.4,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert length value from one unit to another.
     *
     * @param int|float $value
     * @param string $fromUnit
     * @param string $toUnit
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    protected function convertLengthValue(int|float $value, string $fromUnit, string $toUnit): int|float
    {
        if ($fromUnit === $toUnit) {
            return $value;
        }

        return match ($fromUnit) {
            Centimeter::class => $this->convertFromCentimeter(to: $toUnit, value: $value),
            Foot::class => $this->convertFromFoot(to: $toUnit, value: $value),
            Inch::class => $this->convertFromInch(to: $toUnit, value: $value),
            Kilometer::class => $this->convertFromKilometer(to: $toUnit, value: $value),
            Meter::class => $this->convertFromMeter(to: $toUnit, value: $value),
            Mile::class => $this->convertFromMile(to: $toUnit, value: $value),
            Millimeter::class => $this->convertFromMillimeter(to: $toUnit, value: $value),
            Yard::class => $this->convertFromYard(to: $toUnit, value: $value),
            default => $value
        };
    }
}
