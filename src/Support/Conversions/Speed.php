<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Support\Conversions;

use Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion;
use Rugaard\WeatherKit\Units\Speed\FootPerSecond;
use Rugaard\WeatherKit\Units\Speed\KilometerPerHour;
use Rugaard\WeatherKit\Units\Speed\KilometerPerSecond;
use Rugaard\WeatherKit\Units\Speed\Knot;
use Rugaard\WeatherKit\Units\Speed\MeterPerSecond;
use Rugaard\WeatherKit\Units\Speed\MilePerHour;

/**
 * Trait Speed.
 *
 * @package Rugaard\WeatherKit\Support\Conversions
 */
trait Speed
{
    /**
     * Convert from "feet per second".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromFootPerSecond(string $to, int|float $value): int|float
    {
        return match ($to) {
            KilometerPerHour::class => $value * 1.09728,
            KilometerPerSecond::class => $value * 0.000305,
            Knot::class => $value * 0.592484,
            MeterPerSecond::class => $value * 0.3048,
            MilePerHour::class => $value * 0.681818,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "kilometers per hour".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromKilometerPerHour(string $to, int|float $value): int|float
    {
        return match ($to) {
            FootPerSecond::class => $value * 0.911344,
            KilometerPerSecond::class => $value * 0.000305,
            Knot::class => $value * 0.539957,
            MeterPerSecond::class => $value * 0.277778,
            MilePerHour::class => $value / 1.609344,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "kilometers per second".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromKilometerPerSecond(string $to, int|float $value): int|float
    {
        return match ($to) {
            FootPerSecond::class => $value * 3280.839895,
            KilometerPerHour::class => $value * 3600,
            Knot::class => $value * 1943.844492,
            MeterPerSecond::class => $value * 1000,
            MilePerHour::class => $value * 2236.936292,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "Knot".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromKnot(string $to, int|float $value): int|float
    {
        return match ($to) {
            FootPerSecond::class => $value * 1.68781,
            KilometerPerHour::class => $value * 1.852,
            KilometerPerSecond::class => $value * 0.000514,
            MeterPerSecond::class => $value * 0.514444,
            MilePerHour::class => $value * 1.150779,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "meters per second".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromMeterPerSecond(string $to, int|float $value): int|float
    {
        return match ($to) {
            FootPerSecond::class => $value * 0.911344,
            KilometerPerHour::class => $value * 3.6,
            KilometerPerSecond::class => $value / 1000,
            Knot::class => $value * 1.943844,
            MilePerHour::class => $value * 2.236936,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert from "miles per hour".
     *
     * @param string $to
     * @param int|float $value
     * @return int|float
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    final protected function convertFromMilePerHour(string $to, int|float $value): int|float
    {
        return match ($to) {
            FootPerSecond::class => $value * 1.466667,
            KilometerPerHour::class => $value * 1.609344,
            KilometerPerSecond::class => $value * 0.000447,
            Knot::class => $value * 0.868976,
            MeterPerSecond::class => $value * 0.44704,
            default => throw new UnsupportedUnitConversion(message: 'Unsupported unit conversion [' . $to . ']', code: 500)
        };
    }

    /**
     * Convert speed value from one unit to another.
     *
     * @param int|float $value
     * @param string $fromUnit
     * @param string $toUnit
     * @return float|int
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    protected function convertSpeedValue(int|float $value, string $fromUnit, string $toUnit): int|float
    {
        if ($fromUnit === $toUnit) {
            return $value;
        }

        return match ($fromUnit) {
            FootPerSecond::class => $this->convertFromFootPerSecond(to: $toUnit, value: $value),
            KilometerPerHour::class => $this->convertFromKilometerPerHour(to: $toUnit, value: $value),
            KilometerPerSecond::class => $this->convertFromKilometerPerSecond(to: $toUnit, value: $value),
            Knot::class => $this->convertFromKnot(to: $toUnit, value: $value),
            MeterPerSecond::class => $this->convertFromMeterPerSecond(to: $toUnit, value: $value),
            MilePerHour::class => $this->convertFromMilePerHour(to: $toUnit, value: $value),
            default => $value
        };
    }
}
