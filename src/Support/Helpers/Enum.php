<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Support\Helpers;

use ValueError;

use function array_filter;
use function array_values;

/**
 * Trait Enum.
 *
 * @package Rugaard\WeatherKit\Support\Helpers
 */
trait Enum
{
    /**
     * Get enum by name.
     *
     * @static
     * @param string $case
     * @return $this
     */
    public static function fromName(string $case): self
    {
        return self::tryFromName(case: $case) ?? throw new ValueError(message: 'No case matched [' . $case . '] for [' . self::class . ']', code: 500);
    }

    /**
     * Get enum by name (if it exists).
     *
     * @static
     * @returns $this|null
     */
    public static function tryFromName(string $case): ?self
    {
        return array_values(array: array_filter(array: self::cases(), callback: static fn ($c) => $c->name === $case))[0] ?? null;
    }
}
