<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Units\Length;

use Rugaard\WeatherKit\Contracts\Unit;

/**
 * Class Meter.
 *
 * @package Rugaard\WeatherKit\Units\Length
 */
class Meter implements Unit
{
    /**
     * Name of unit.
     *
     * @var string
     */
    protected string $name = 'Meter';

    /**
     * Abbreviation of unit name.
     *
     * @var string
     */
    protected string $abbreviation = 'm';

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
