<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * WeatherCondition.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum WeatherCondition: string
{
    use EnumHelpers;

    /**
     * Visible conditions.
     */
    case Clear = 'Clear';
    case Cloudy = 'Cloudy';
    case Haze = 'Haze';
    case MostlyClear = 'Mostly clear';
    case MostlyCloudy = 'Mostly cloudy';
    case PartlyCloudy = 'Partly cloudy';
    case ScatteredThunderstorms = 'Scattered thunderstorms';

    /**
     * Wind conditions.
     *
     * @var string
     */
    case Breezy = 'Breezy';
    case Windy = 'Windy';

    /**
     * Precipitation conditions.
     *
     * @var string
     */
    case Drizzle = 'Drizzle';
    case HeavyRain = 'Heavy rain';
    case Rain = 'Rain';

    /**
     * Winter precipitation conditions.
     *
     * @var string
     */
    case Flurries = 'Flurries';
    case HeavySnow = 'Heavy snow';
    case Sleet = 'Sleet';
    case Snow = 'Snow';

    /**
     * Hazardous conditions
     *
     * @var string
     */
    case Blizzard = 'Blizzard';
    case BlowingSnow = 'Blowing snow';
    case FreezingDrizzle = 'Freezing drizzle';
    case FreezingRain = 'Freezing rain';
    case Frigid = 'Frigid';
    case Hail = 'Hail';
    case Hot = 'Hot';
    case Hurricane = 'Hurricane';
    case IsolatedThunderstorms = 'Isolated thunderstorms';
    case SevereThunderstorm = 'Severe thunderstorm';
    case TropicalStorm = 'Tropical storm';

    /**
     * Other conditions.
     *
     * @var string
     */
    case BlowingDust = 'Blowing dust';
    case Foggy = 'Foggy';
    case Smoky = 'Smoky';
    case StrongStorms = 'Strong storms';
    case SunFlurries = 'Sun flurries';
    case SunShowers = 'Sun showers';
    case Thunderstorms = 'Thunderstorms';
    case WintryMix = 'Wintry mix';

    /**
     * Get weather condition as an emoji.
     *
     * @return string
     */
    public function asEmoji(): string
    {
        return match ($this) {
            self::Clear => '☀️',
            self::MostlyClear => '🌤️',
            self::PartlyCloudy => '⛅️️',
            self::MostlyCloudy => '🌥',
            self::Cloudy => '☁️',
            self::ScatteredThunderstorms, self::Thunderstorms, self::IsolatedThunderstorms, self::SevereThunderstorm => '⚡️',
            self::Breezy, self::Windy, self::StrongStorms => '💨',
            self::Hurricane, self::TropicalStorm => '🌪',
            self::Drizzle, self::FreezingDrizzle, self::FreezingRain, self::HeavyRain, self::Rain => '🌧',
            self::SunFlurries, self::SunShowers => '🌦',
            self::Flurries, self::HeavySnow, self::Snow => '❄️',
            self::Sleet, self::WintryMix => '🌨',
            self::Hail => '🧊',
            self::Blizzard, self::BlowingDust, self::BlowingSnow => '🌬',
            self::Foggy, self::Haze, self::Smoky => '🌫',
            self::Frigid => '🥶',
            self::Hot => '🥵',
            default => '❓'
        };
    }
}
