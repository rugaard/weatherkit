<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Units;

use Rugaard\WeatherKit\Contracts\Unit;

/**
 * Class Bearing.
 *
 * @package Rugaard\WeatherKit\Units
 */
class Bearing implements Unit
{
    /**
     * Name of unit.
     *
     * @var string
     */
    protected string $name = 'Bearing';

    /**
     * Abbreviation of unit name.
     *
     * @var string
     */
    protected string $abbreviation = '°';

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
