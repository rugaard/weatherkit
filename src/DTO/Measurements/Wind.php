<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Measurements;

use Rugaard\WeatherKit\Contracts\Unit;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\Support\Conversions\Speed as SpeedConversions;
use Rugaard\WeatherKit\Units\Speed\FootPerSecond;
use Rugaard\WeatherKit\Units\Speed\KilometerPerHour;
use Rugaard\WeatherKit\Units\Speed\KilometerPerSecond;
use Rugaard\WeatherKit\Units\Speed\Knot;
use Rugaard\WeatherKit\Units\Speed\MeterPerSecond;
use Rugaard\WeatherKit\Units\Speed\MilePerHour;

/**
 * Wind.
 *
 * @package Rugaard\WeatherKit\DTO\Measurements
 */
class Wind extends AbstractDTO
{
    use SpeedConversions;

    /**
     * Wind speed value.
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
     * Wind constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        // Set unit of measurement.
        $this->setUnit(unit: new KilometerPerHour);

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
     * Set wind value.
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
     * Get wind value.
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Set wind unit.
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
     * Get wind unit.
     *
     * @return \Rugaard\WeatherKit\Contracts\Unit
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * Change unit to "Feet per second".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asFootPerSecond(): self
    {
        return $this->setValue(value: $this->convertSpeedValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: FootPerSecond::class))->setUnit(unit: new FootPerSecond);
    }

    /**
     * Change unit to "Kilometers per hour".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asKilometerPerHour(): self
    {
        return $this->setValue(value: $this->convertSpeedValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: KilometerPerHour::class))->setUnit(unit: new KilometerPerHour);
    }

    /**
     * Change unit to "Kilometers per second".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asKilometerPerSecond(): self
    {
        return $this->setValue(value: $this->convertSpeedValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: KilometerPerSecond::class))->setUnit(unit: new KilometerPerSecond);
    }

    /**
     * Change unit to "Knot".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asKnot(): self
    {
        return $this->setValue(value: $this->convertSpeedValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Knot::class))->setUnit(unit: new Knot);
    }

    /**
     * Change unit to "Meters per second".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asMeterPerSecond(): self
    {
        return $this->setValue(value: $this->convertSpeedValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: MeterPerSecond::class))->setUnit(unit: new MeterPerSecond);
    }

    /**
     * Change unit to "Miles per hour".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asMilePerHour(): self
    {
        return $this->setValue(value: $this->convertSpeedValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: MilePerHour::class))->setUnit(unit: new MilePerHour);
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
