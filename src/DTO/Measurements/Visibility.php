<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Measurements;

use Rugaard\WeatherKit\Contracts\Unit;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\Support\Conversions\Length as LengthConversion;
use Rugaard\WeatherKit\Units\Length\Centimeter;
use Rugaard\WeatherKit\Units\Length\Foot;
use Rugaard\WeatherKit\Units\Length\Inch;
use Rugaard\WeatherKit\Units\Length\Kilometer;
use Rugaard\WeatherKit\Units\Length\Meter;
use Rugaard\WeatherKit\Units\Length\Mile;
use Rugaard\WeatherKit\Units\Length\Millimeter;
use Rugaard\WeatherKit\Units\Length\Yard;

/**
 * Visibility.
 *
 * @package Rugaard\WeatherKit\DTO\Measurements
 */
class Visibility extends AbstractDTO
{
    use LengthConversion;

    /**
     * Visibility value.
     *
     * @var float
     */
    protected float $value;

    /**
     * Unit type.
     *
     * @var \Rugaard\WeatherKit\Contracts\Unit
     */
    protected Unit $unit;

    /**
     * Visibility constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        // Set unit of measurement.
        $this->setUnit(unit: new Meter);

        parent::__construct(data: $data);
    }

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     */
    public function parse(array $data): void
    {
        $this->setValue(value: $data['value']);
    }

    /**
     * Set pressure value.
     *
     * @param  int|float $value
     * @return $this
     */
    public function setValue(int|float $value): self
    {
        $this->value = (float) $value;
        return $this;
    }

    /**
     * Get pressure value.
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Set pressure unit.
     *
     * @param  \Rugaard\WeatherKit\Contracts\Unit $unit
     * @return $this
     */
    public function setUnit(Unit $unit): self
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * Get pressure unit.
     *
     * @return \Rugaard\WeatherKit\Contracts\Unit
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * Change unit to "Centimeters".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asCentimeters(): self
    {
        return $this->setValue(value: $this->convertLengthValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Centimeter::class))->setUnit(unit: new Centimeter);
    }

    /**
     * Change unit to "Feet".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asFeet(): self
    {
        return $this->setValue(value: $this->convertLengthValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Foot::class))->setUnit(unit: new Foot);
    }

    /**
     * Change unit to "Inches".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asInches(): self
    {
        return $this->setValue(value: $this->convertLengthValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Inch::class))->setUnit(unit: new Inch);
    }

    /**
     * Change unit to "Kilometers".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asKilometers(): self
    {
        return $this->setValue(value: $this->convertLengthValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Kilometer::class))->setUnit(unit: new Kilometer);
    }

    /**
     * Change unit to "Meters".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asMeters(): self
    {
        return $this->setValue(value: $this->convertLengthValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Meter::class))->setUnit(unit: new Meter);
    }

    /**
     * Change unit to "Miles".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asMiles(): self
    {
        return $this->setValue(value: $this->convertLengthValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Mile::class))->setUnit(unit: new Mile);
    }

    /**
     * Change unit to "Millimeters".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asMillimeters(): self
    {
        return $this->setValue(value: $this->convertLengthValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Millimeter::class))->setUnit(unit: new Millimeter);
    }

    /**
     * Change unit to "Yards".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asYards(): self
    {
        return $this->setValue(value: $this->convertLengthValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Yard::class))->setUnit(unit: new Yard);
    }

    /**
     * __toString().
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue() . ' ' . $this->getUnit();
    }
}
