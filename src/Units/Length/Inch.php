<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Units\Length;

use Rugaard\WeatherKit\Contracts\Unit;

/**
 * Class Inch.
 *
 * @package Rugaard\WeatherKit\Units\Length
 */
class Inch implements Unit
{
    /**
     * Name of unit.
     *
     * @var string
     */
    protected string $name = 'Inch';

    /**
     * Abbreviation of unit name.
     *
     * @var string
     */
    protected string $abbreviation = 'in';

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
