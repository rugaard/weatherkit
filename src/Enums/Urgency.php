<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * Urgency.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum Urgency: string
{
    use EnumHelpers;

    /**
     * Urgency values.
     *
     * @var string
     */
    case Expected = 'expected';
    case Future = 'future';
    case Immediate = 'immediate';
    case Past = 'past';
    case Unknown = 'unknown';

    /**
     * Get as human-readable description.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::Expected => 'Take responsive action in the next hour',
            self::Future => 'Take responsive action in the near future',
            self::Immediate => 'Take responsive action immediately',
            self::Past => 'Responsive action is no longer required',
            self::Unknown => 'Urgency is unknown',
            default => 'Unknown urgency value'
        };
    }
}
