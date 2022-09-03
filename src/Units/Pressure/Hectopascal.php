<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Units\Pressure;

use Rugaard\WeatherKit\Contracts\Unit;

/**
 * Class Hectopascal.
 *
 * @package Rugaard\WeatherKit\Units\Pressure
 */
class Hectopascal implements Unit
{
    /**
     * Name of unit.
     *
     * @var string
     */
    protected string $name = 'Hectopascal';

    /**
     * Abbreviation of unit name.
     *
     * @var string
     */
    protected string $abbreviation = 'hPa';

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
