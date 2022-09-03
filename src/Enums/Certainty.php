<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * Certainty.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum Certainty: string
{
    use EnumHelpers;

    /**
     * Certainty values.
     *
     * @var string
     */
    case Likely = 'likely';
    case Observed = 'observed';
    case Possible = 'possible';
    case Unknown = 'unknown';
    case Unlikely = 'unlikely';

    /**
     * Get as human-readable description.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::Likely => 'The event is likely to occur (greater than 50% probability)',
            self::Observed => 'The event has already occurred or is ongoing',
            self::Possible => 'The event is unlikely to occur (less than 50% probability)',
            self::Unknown => 'Unknown if the event will occur',
            self::Unlikely => 'The event is not expected to occur (approximately 0% probability)',
            default => 'Unknown certainty'
        };
    }
}
