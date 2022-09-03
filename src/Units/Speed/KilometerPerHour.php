<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Units\Speed;

use Rugaard\WeatherKit\Contracts\Unit;

/**
 * Class KilometerPerHour.
 *
 * @package Rugaard\WeatherKit\Units\Speed
 */
class KilometerPerHour implements Unit
{
    /**
     * Name of unit.
     *
     * @var string
     */
    protected string $name = 'Kilometer per hour';

    /**
     * Abbreviation of unit name.
     *
     * @var string
     */
    protected string $abbreviation = 'km/h';

    /**
     * Get unit name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get unit abbreviation.
     *
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    /**
     * Get unit as a string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getAbbreviation();
    }
}
