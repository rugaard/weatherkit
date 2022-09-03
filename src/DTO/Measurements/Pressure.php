<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Measurements;

use Rugaard\WeatherKit\Contracts\Unit;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\Enums\Pressure as PressureTrend;
use Rugaard\WeatherKit\Support\Conversions\Pressure as PressureConversion;
use Rugaard\WeatherKit\Units\Pressure\Bar;
use Rugaard\WeatherKit\Units\Pressure\Hectopascal;
use Rugaard\WeatherKit\Units\Pressure\KilogramForcePerSquareCentimeter;
use Rugaard\WeatherKit\Units\Pressure\KilogramForcePerSquareMeter;
use Rugaard\WeatherKit\Units\Pressure\Millibar;
use Rugaard\WeatherKit\Units\Pressure\Pascal;

/**
 * Pressure.
 *
 * @package Rugaard\WeatherKit\DTO\Measurements
 */
class Pressure extends AbstractDTO
{
    use PressureConversion;

    /**
     * Pressure value.
     *
     * @var float
     */
    protected float $value;

    /**
     * Pressure trend.
     *
     * @var \Rugaard\WeatherKit\Enums\Pressure
     */
    protected PressureTrend $trend;

    /**
     * Unit type.
     *
     * @var \Rugaard\WeatherKit\Contracts\Unit
     */
    protected Unit $unit;

    /**
     * Pressure constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        // Set unit of measurement.
        $this->setUnit(unit: new Millibar);

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
        $this->setValue(value: $data['value'])
             ->setTrend(trend: $data['trend']);
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
     * Set pressure trend.
     *
     * @param string $trend
     * @return $this
     */
    public function setTrend(string $trend): self
    {
        $this->trend = PressureTrend::from(value: $trend);
        return $this;
    }

    /**
     * Get pressure trend.
     *
     * @return \Rugaard\WeatherKit\Enums\Pressure
     */
    public function getTrend(): PressureTrend
    {
        return $this->trend;
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
     * Change unit to "Bars".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asBars(): self
    {
        return $this->setValue(value: $this->convertPressureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Bar::class))->setUnit(unit: new Bar);
    }

    /**
     * Change unit to "Millibars".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asMillibars(): self
    {
        return $this->setValue(value: $this->convertPressureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Millibar::class))->setUnit(unit: new Millibar);
    }

    /**
     * Change unit to "Hectopascal".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asHectopascal(): self
    {
        return $this->setValue(value: $this->convertPressureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Hectopascal::class))->setUnit(unit: new Hectopascal);
    }

    /**
     * Change unit to "Pascal".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asPascal(): self
    {
        return $this->setValue(value: $this->convertPressureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: Pascal::class))->setUnit(unit: new Pascal);
    }

    /**
     * Change unit to "Kilograms per square centimeter".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asKilogramForcePerSquareCentimeter(): self
    {
        return $this->setValue(value: $this->convertPressureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: KilogramForcePerSquareCentimeter::class))->setUnit(unit: new KilogramForcePerSquareCentimeter);
    }

    /**
     * Change unit to "Kilograms per square meter".
     *
     * @return $this
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function asKilogramForcePerSquareMeter(): self
    {
        return $this->setValue(value: $this->convertPressureValue(value: $this->getValue(), fromUnit: $this->getUnit()::class, toUnit: KilogramForcePerSquareMeter::class))->setUnit(unit: new KilogramForcePerSquareMeter);
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
