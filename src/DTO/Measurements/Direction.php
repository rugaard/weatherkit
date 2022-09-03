<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Measurements;

use Rugaard\WeatherKit\Contracts\Unit;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\Units\Bearing;

/**
 * Wind direction.
 *
 * @package Rugaard\WeatherKit\DTO\Measurements
 */
class Direction extends AbstractDTO
{
    /**
     * Wind direction value.
     *
     * @var int
     */
    protected int $value;

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
        $this->setUnit(unit: new Bearing);

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
     * @param  int $value
     * @return $this
     */
    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get wind value.
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Get direction name as text.
     *
     * @return string
     */
    public function asText(): string
    {
        return match (true) {
            $this->getValue() >= 11.25 && $this->getValue() < 33.75 => 'North North-East',
            $this->getValue() >= 33.75 && $this->getValue() < 56.25 => 'North-East',
            $this->getValue() >= 56.25 && $this->getValue() < 78.75 => 'East North-East',
            $this->getValue() >= 78.75 && $this->getValue() < 101.25 => 'East',
            $this->getValue() >= 101.25 && $this->getValue() < 123.75 => 'East South-East',
            $this->getValue() >= 123.75 && $this->getValue() < 146.25 => 'South-East',
            $this->getValue() >= 146.25 && $this->getValue() < 168.75 => 'South South-East',
            $this->getValue() >= 168.75 && $this->getValue() < 191.25 => 'South',
            $this->getValue() >= 191.25 && $this->getValue() < 213.75 => 'South South-West',
            $this->getValue() >= 213.75 && $this->getValue() < 236.25 => 'South-West',
            $this->getValue() >= 236.25 && $this->getValue() < 258.75 => 'West South-West',
            $this->getValue() >= 258.75 && $this->getValue() < 281.25 => 'West',
            $this->getValue() >= 281.25 && $this->getValue() < 303.75 => 'West North-West',
            $this->getValue() >= 303.75 && $this->getValue() < 326.25 => 'North-West',
            $this->getValue() >= 326.25 && $this->getValue() < 348.75 => 'North North-West',
            default => 'North'
        };
    }

    /**
     * Get direction name as abbreviation.
     *
     * @return string
     */
    public function asAbbreviation(): string
    {
        return match (true) {
            $this->getValue() >= 11.25 && $this->getValue() < 33.75 => 'NNE',
            $this->getValue() >= 33.75 && $this->getValue() < 56.25 => 'NE',
            $this->getValue() >= 56.25 && $this->getValue() < 78.75 => 'ENE',
            $this->getValue() >= 78.75 && $this->getValue() < 101.25 => 'E',
            $this->getValue() >= 101.25 && $this->getValue() < 123.75 => 'ESE',
            $this->getValue() >= 123.75 && $this->getValue() < 146.25 => 'SE',
            $this->getValue() >= 146.25 && $this->getValue() < 168.75 => 'SSE',
            $this->getValue() >= 168.75 && $this->getValue() < 191.25 => 'S',
            $this->getValue() >= 191.25 && $this->getValue() < 213.75 => 'SSW',
            $this->getValue() >= 213.75 && $this->getValue() < 236.25 => 'SW',
            $this->getValue() >= 236.25 && $this->getValue() < 258.75 => 'WSW',
            $this->getValue() >= 258.75 && $this->getValue() < 281.25 => 'W',
            $this->getValue() >= 281.25 && $this->getValue() < 303.75 => 'WNW',
            $this->getValue() >= 303.75 && $this->getValue() < 326.25 => 'NW',
            $this->getValue() >= 326.25 && $this->getValue() < 348.75 => 'NNW',
            default => 'N'
        };
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
     * __toString().
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue() . $this->getUnit();
    }
}
