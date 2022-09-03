<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * Severity.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum Severity: string
{
    use EnumHelpers;

    /**
     * Severity values.
     *
     * @var string
     */
    case Extreme = 'extreme';
    case Minor = 'minor';
    case Moderate = 'moderate';
    case Severe = 'severe';
    case Unknown = 'unknown';

    /**
     * Get as human-readable description.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::Extreme => 'Extraordinary threat',
            self::Minor => 'Minimal or no known threat',
            self::Moderate => 'Possible threat',
            self::Severe => 'Significant threat',
            self::Unknown => 'Unknown threat',
            default => 'Unknown threat value'
        };
    }
}
