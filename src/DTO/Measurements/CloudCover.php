<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Measurements;

use Rugaard\WeatherKit\Contracts\Unit;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\Units\Percentage;

/**
 * CloudCover.
 *
 * @package Rugaard\WeatherKit\DTO\Measurements
 */
class CloudCover extends AbstractDTO
{
    /**
     * Cloud cover value.
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
     * CloudCover constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        // Set unit of measurement.
        $this->setUnit(unit: new Percentage);

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
     * Set cloud cover value.
     *
     * @param  int|float $value
     * @return $this
     */
    public function setValue(int|float $value): self
    {
        $this->value = (float) $value * 100;
        return $this;
    }

    /**
     * Get cloud cover value.
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Set cloud cover unit.
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
     * Get cloud cover unit.
     *
     * @return \Rugaard\WeatherKit\Contracts\Unit
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * __toString().
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue() . $this->getUnit();
    }
}
