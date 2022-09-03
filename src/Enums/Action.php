<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * Action.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum Action: string
{
    use EnumHelpers;

    /**
     * Action values.
     *
     * @var string
     */
    case AllClear = 'allClear';
    case Assess = 'assess';
    case Avoid = 'avoid';
    case Evacuate = 'evacuate';
    case Execute = 'execute';
    case Monitor = 'monitor';
    case None = 'none';
    case Prepare = 'prepare';
    case Shelter = 'shelter';

    /**
     * Get as human-readable description.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::AllClear => 'The event no longer poses a threat',
            self::Assess => 'Assess the situation',
            self::Avoid => 'Avoid the event',
            self::Evacuate => 'Relocate',
            self::Execute => 'Execute a pre-planned activity',
            self::Monitor => 'Monitor the situation',
            self::None => 'No action recommended',
            self::Prepare => 'Make preparations',
            self::Shelter => 'Take shelter in place',
            default => 'Unknown action'
        };
    }
}
