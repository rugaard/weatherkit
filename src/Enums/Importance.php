<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * Importance.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum Importance: string
{
    use EnumHelpers;

    /**
     * Importance values.
     *
     * @var string
     */
    case Low = 'low';
    case High = 'high';
    case Normal = 'normal';

    /**
     * Description of importance.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::Low => 'Low importance',
            self::High => 'High importance',
            self::Normal => 'Normal importance',
        };
    }
}
