<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Measurements;

use Rugaard\WeatherKit\Contracts\Unit;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\Support\Conversions\Temperature as TemperatureConversion;
use Rugaard\WeatherKit\Units\Temperature\Celsius;
use Rugaard\WeatherKit\Units\Temperature\Fahrenheit;
use Rugaard\WeatherKit\Units\Temperature\Kelvin;

/**
 * Temperature.
 *
 * @package Rugaard\WeatherKit\DTO\Measurements
 */
class Temperature extends AbstractDTO
{
    use TemperatureConversion;

    /**
     * Temperature value.
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
     * Temperature constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        // Set unit of measurement.
        $this->setUnit(unit: new Celsius);

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
     * Set temperature value.
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
     * Get temperature value.
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Set temperature unit.
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
     * Get temperature unit.
     *
     * @return \Rugaard\WeatherKit\Contracts\Unit
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * Change temperature to celsius.
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asCelsius(): self
    {
        return $this->setValue(value: $this->convertTemperatureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Celsius::class))->setUnit(unit: new Celsius);
    }

    /**
     * Change temperature to fahrenheit.
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asFahrenheit(): self
    {
        return $this->setValue(value: $this->convertTemperatureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Fahrenheit::class))->setUnit(unit: new Fahrenheit);
    }

    /**
     * Change temperature to kelvin.
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asKelvin(): self
    {
        return $this->setValue(value: $this->convertTemperatureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Kelvin::class))->setUnit(unit: new Kelvin);
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
