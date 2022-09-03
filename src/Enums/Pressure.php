<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * Pressure.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum Pressure: string
{
    use EnumHelpers;

    /**
     * Pressure values.
     *
     * @var string
     */
    case Falling = 'falling';
    case Rising = 'rising';
    case Steady = 'steady';

    /**
     * Description of pressure.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::Falling => 'The sea level air pressure is decreasing',
            self::Rising => 'The sea level air pressure is increasing',
            self::Steady => 'The sea level air pressure is remaining about the same',
        };
    }
}
