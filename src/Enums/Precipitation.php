<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * Precipitation.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum Precipitation: string
{
    use EnumHelpers;

    /**
     * Precipitation values.
     *
     * @var string
     */
    case Clear = 'clear';
    case Hail = 'hail';
    case Mixed = 'mixed';
    case Rain = 'rain';
    case Sleet = 'sleet';
    case Snow = 'snow';
    case Unknown = 'precipitation';

    /**
     * Description of precipitation.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::Clear => 'No precipitation is occurring',
            self::Hail => 'Hail is falling',
            self::Mixed => 'Winter weather (wintery mix or wintery showers) is falling',
            self::Rain => 'Rain or freezing rain is falling',
            self::Sleet => 'Sleet or ice pellets are falling',
            self::Snow => 'Snow is falling',
            self::Unknown => 'An unknown type of precipitation is occuring',
            default => 'Unknown precipitation'
        };
    }
}
