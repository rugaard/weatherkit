<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Enums;

use Rugaard\WeatherKit\Support\Helpers\Enum as EnumHelpers;

/**
 * Moon.
 *
 * @package Rugaard\WeatherKit\Enums
 */
enum Moon: string
{
    use EnumHelpers;

    /**
     * Moon values.
     *
     * @var string
     */
    case FirstQuarter = 'firstQuarter';
    case Full = 'full';
    case New = 'new';
    case ThirdQuarter = 'thirdQuarter';
    case WaningCrescent = 'waningCrescent';
    case WaningGibbous = 'waningGibbous';
    case WaxingCrescent = 'waxingCrescent';
    case WaxingGibbous = 'waxingGibbous';

    /**
     * Description of moon phase.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::FirstQuarter => 'Approximately half of the moon is visible, and increasing in size',
            self::Full => 'The entire disc of the moon is visible',
            self::New => 'The moon isn’t visible',
            self::ThirdQuarter => 'Approximately half of the moon is visible, and decreasing in size',
            self::WaningCrescent => 'A crescent-shaped sliver of the moon is visible, and decreasing in size',
            self::WaningGibbous => 'More than half of the moon is visible, and decreasing in size',
            self::WaxingCrescent => 'A crescent-shaped sliver of the moon is visible, and increasing in size',
            self::WaxingGibbous => 'More than half of the moon is visible, and increasing in size',
        };
    }
}
