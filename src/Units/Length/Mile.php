<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Units\Length;

use Rugaard\WeatherKit\Contracts\Unit;

/**
 * Class Mile.
 *
 * @package Rugaard\WeatherKit\Units\Length
 */
class Mile implements Unit
{
    /**
     * Name of unit.
     *
     * @var string
     */
    protected string $name = 'Mile';

    /**
     * Abbreviation of unit name.
     *
     * @var string
     */
    protected string $abbreviation = 'mi';

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
