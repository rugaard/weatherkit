<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Units\Pressure;

use Rugaard\WeatherKit\Contracts\Unit;

/**
 * Class KilogramForcePerSquareMeter.
 *
 * @package Rugaard\WeatherKit\Units\Pressure
 */
class KilogramForcePerSquareMeter implements Unit
{
    /**
     * Name of unit.
     *
     * @var string
     */
    protected string $name = 'Kilogram-force per square meter';

    /**
     * Abbreviation of unit name.
     *
     * @var string
     */
    protected string $abbreviation = 'kgf/m²';

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
