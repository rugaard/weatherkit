<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * UVIndex.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum UVIndex: int
{
    use EnumHelpers;

    /**
     * Available UV index values.
     *
     * @var int
     */
    case Zero = 0;
    case One = 1;
    case Two = 2;
    case Three = 3;
    case Four = 4;
    case Five = 5;
    case Six = 6;
    case Seven = 7;
    case Eight = 8;
    case Nine = 9;
    case Ten = 10;
    case Eleven = 11;
    case Twelve = 12;
    case Thirteen = 13;
    case Fourteen = 14;
    case Fifteen = 15;
    case Sixteen = 16;
    case Seventeen = 17;
    case Eighteen = 18;
    case Nineteen = 19;
    case Twenty = 20;
    case TwentyOne = 21;
    case TwentyTwo = 22;
    case TwentyThree = 23;
    case TwentyFour = 24;
    case TwentyFive = 25;
    case TwentySix = 26;
    case TwentySeven = 27;
    case TwentyEight = 28;
    case TwentyNine = 29;
    case Thirty = 30;

    /**
     * Get human-readable level of current UV index.
     *
     * @return string
     */
    public function level(): string
    {
        return match ($this) {
            self::Zero, self::One, self::Two => 'Low',
            self::Three, self::Four, self::Five => 'Moderate',
            self::Six, self::Seven => 'High',
            self::Eight, self::Nine, self::Ten => 'Very high',
            default => 'Extreme'
        };
    }

    /**
     * Get a color name representing current UV index.
     *
     * @return string
     */
    public function colorName(): string
    {
        return match ($this) {
            self::Zero, self::One, self::Two => 'green',
            self::Three, self::Four, self::Five => 'yellow',
            self::Six, self::Seven => 'orange',
            self::Eight, self::Nine, self::Ten => 'red',
            default => 'violet'
        };
    }

    /**
     * Get hex color color representing current UV index.
     *
     * @return string
     */
    public function colorAsHex(): string
    {
        return match ($this) {
            self::Zero, self::One, self::Two => '#7bb733',
            self::Three, self::Four, self::Five => '#f7b308',
            self::Six, self::Seven => '#ee8615',
            self::Eight, self::Nine, self::Ten => '#e04028',
            default => '#a85d98'
        };
    }

    /**
     * Get hex color color representing current UV index.
     *
     * @return string
     */
    public function colorAsRGB(): string
    {
        return match ($this) {
            self::Zero, self::One, self::Two => 'rgb(123, 183, 51)',
            self::Three, self::Four, self::Five => 'rgb(247, 179, 8)',
            self::Six, self::Seven => 'rgb(238, 134, 21)',
            self::Eight, self::Nine, self::Ten => 'rgb(224, 64, 40)',
            default => 'rgb(168, 93, 152)'
        };
    }
}
