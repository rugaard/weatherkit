<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Units\Speed;

use Rugaard\WeatherKit\Contracts\Unit;

/**
 * Class FootPerSecond.
 *
 * @package Rugaard\WeatherKit\Units\Speed
 */
class FootPerSecond implements Unit
{
    /**
     * Name of unit.
     *
     * @var string
     */
    protected string $name = 'Foot per second';

    /**
     * Abbreviation of unit name.
     *
     * @var string
     */
    protected string $abbreviation = 'ft/s';

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
