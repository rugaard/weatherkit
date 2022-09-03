<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\WeatherCondition;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * WeatherConditionTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class WeatherConditionTest extends AbstractTestCase
{
    /**
     * Test Clear value.
     *
     * @return void
     */
    public function testClear(): void
    {
        $data = WeatherCondition::fromName(case: 'Clear');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Clear', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Clear', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '☀️', actual: $data->asEmoji());
    }

    /**
     * Test MostlyClear value.
     *
     * @return void
     */
    public function testMostlyClear(): void
    {
        $data = WeatherCondition::fromName(case: 'MostlyClear');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'MostlyClear', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Mostly clear', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌤️', actual: $data->asEmoji());
    }

    /**
     * Test PartlyCloudy value.
     *
     * @return void
     */
    public function testPartlyCloudy(): void
    {
        $data = WeatherCondition::fromName(case: 'PartlyCloudy');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'PartlyCloudy', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Partly cloudy', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '⛅️️', actual: $data->asEmoji());
    }

    /**
     * Test MostlyCloudy value.
     *
     * @return void
     */
    public function testMostlyCloudy(): void
    {
        $data = WeatherCondition::fromName(case: 'MostlyCloudy');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'MostlyCloudy', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Mostly cloudy', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌥', actual: $data->asEmoji());
    }

    /**
     * Test Cloudy value.
     *
     * @return void
     */
    public function testCloudy(): void
    {
        $data = WeatherCondition::fromName(case: 'Cloudy');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Cloudy', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Cloudy', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '☁️', actual: $data->asEmoji());
    }

    /**
     * Test ScatteredThunderstorms value.
     *
     * @return void
     */
    public function testScatteredThunderstorms(): void
    {
        $data = WeatherCondition::fromName(case: 'ScatteredThunderstorms');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'ScatteredThunderstorms', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Scattered thunderstorms', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '⚡️', actual: $data->asEmoji());
    }

    /**
     * Test Thunderstorms value.
     *
     * @return void
     */
    public function testThunderstorms(): void
    {
        $data = WeatherCondition::fromName(case: 'Thunderstorms');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Thunderstorms', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Thunderstorms', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '⚡️', actual: $data->asEmoji());
    }

    /**
     * Test IsolatedThunderstorms value.
     *
     * @return void
     */
    public function testIsolatedThunderstorms(): void
    {
        $data = WeatherCondition::fromName(case: 'IsolatedThunderstorms');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'IsolatedThunderstorms', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Isolated thunderstorms', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '⚡️', actual: $data->asEmoji());
    }

    /**
     * Test SevereThunderstorm value.
     *
     * @return void
     */
    public function testSevereThunderstorm(): void
    {
        $data = WeatherCondition::fromName(case: 'SevereThunderstorm');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'SevereThunderstorm', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Severe thunderstorm', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '⚡️', actual: $data->asEmoji());
    }

    /**
     * Test Breezy value.
     *
     * @return void
     */
    public function testBreezy(): void
    {
        $data = WeatherCondition::fromName(case: 'Breezy');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Breezy', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Breezy', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '💨', actual: $data->asEmoji());
    }

    /**
     * Test Windy value.
     *
     * @return void
     */
    public function testWindy(): void
    {
        $data = WeatherCondition::fromName(case: 'Windy');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Windy', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Windy', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '💨', actual: $data->asEmoji());
    }

    /**
     * Test StrongStorms value.
     *
     * @return void
     */
    public function testStrongStorms(): void
    {
        $data = WeatherCondition::fromName(case: 'StrongStorms');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'StrongStorms', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Strong storms', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '💨', actual: $data->asEmoji());
    }

    /**
     * Test Hurricane value.
     *
     * @return void
     */
    public function testHurricane(): void
    {
        $data = WeatherCondition::fromName(case: 'Hurricane');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Hurricane', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Hurricane', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌪', actual: $data->asEmoji());
    }

    /**
     * Test TropicalStorm value.
     *
     * @return void
     */
    public function testTropicalStorm(): void
    {
        $data = WeatherCondition::fromName(case: 'TropicalStorm');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'TropicalStorm', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Tropical storm', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌪', actual: $data->asEmoji());
    }

    /**
     * Test Drizzle value.
     *
     * @return void
     */
    public function testDrizzle(): void
    {
        $data = WeatherCondition::fromName(case: 'Drizzle');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Drizzle', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Drizzle', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌧', actual: $data->asEmoji());
    }

    /**
     * Test FreezingDrizzle value.
     *
     * @return void
     */
    public function testFreezingDrizzle(): void
    {
        $data = WeatherCondition::fromName(case: 'FreezingDrizzle');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'FreezingDrizzle', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Freezing drizzle', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌧', actual: $data->asEmoji());
    }

    /**
     * Test FreezingRain value.
     *
     * @return void
     */
    public function testFreezingRain(): void
    {
        $data = WeatherCondition::fromName(case: 'FreezingRain');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'FreezingRain', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Freezing rain', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌧', actual: $data->asEmoji());
    }

    /**
     * Test HeavyRain value.
     *
     * @return void
     */
    public function testHeavyRain(): void
    {
        $data = WeatherCondition::fromName(case: 'HeavyRain');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'HeavyRain', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Heavy rain', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌧', actual: $data->asEmoji());
    }

    /**
     * Test Rain value.
     *
     * @return void
     */
    public function testRain(): void
    {
        $data = WeatherCondition::fromName(case: 'Rain');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Rain', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Rain', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌧', actual: $data->asEmoji());
    }

    /**
     * Test SunFlurries value.
     *
     * @return void
     */
    public function testSunFlurries(): void
    {
        $data = WeatherCondition::fromName(case: 'SunFlurries');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'SunFlurries', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Sun flurries', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌦', actual: $data->asEmoji());
    }

    /**
     * Test SunShowers value.
     *
     * @return void
     */
    public function testSunShowers(): void
    {
        $data = WeatherCondition::fromName(case: 'SunShowers');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'SunShowers', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Sun showers', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌦', actual: $data->asEmoji());
    }

    /**
     * Test Flurries value.
     *
     * @return void
     */
    public function testFlurries(): void
    {
        $data = WeatherCondition::fromName(case: 'Flurries');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Flurries', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Flurries', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '❄️', actual: $data->asEmoji());
    }

    /**
     * Test HeavySnow value.
     *
     * @return void
     */
    public function testHeavySnow(): void
    {
        $data = WeatherCondition::fromName(case: 'HeavySnow');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'HeavySnow', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Heavy snow', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '❄️', actual: $data->asEmoji());
    }

    /**
     * Test Snow value.
     *
     * @return void
     */
    public function testSnow(): void
    {
        $data = WeatherCondition::fromName(case: 'Snow');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Snow', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Snow', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '❄️', actual: $data->asEmoji());
    }

    /**
     * Test Sleet value.
     *
     * @return void
     */
    public function testSleet(): void
    {
        $data = WeatherCondition::fromName(case: 'Sleet');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Sleet', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Sleet', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌨', actual: $data->asEmoji());
    }

    /**
     * Test WintryMix value.
     *
     * @return void
     */
    public function testWintryMix(): void
    {
        $data = WeatherCondition::fromName(case: 'WintryMix');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'WintryMix', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Wintry mix', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌨', actual: $data->asEmoji());
    }

    /**
     * Test Hail value.
     *
     * @return void
     */
    public function testHail(): void
    {
        $data = WeatherCondition::fromName(case: 'Hail');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Hail', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Hail', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🧊', actual: $data->asEmoji());
    }

    /**
     * Test Blizzard value.
     *
     * @return void
     */
    public function testBlizzard(): void
    {
        $data = WeatherCondition::fromName(case: 'Blizzard');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Blizzard', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Blizzard', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌬', actual: $data->asEmoji());
    }

    /**
     * Test BlowingDust value.
     *
     * @return void
     */
    public function testBlowingDust(): void
    {
        $data = WeatherCondition::fromName(case: 'BlowingDust');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'BlowingDust', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Blowing dust', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌬', actual: $data->asEmoji());
    }

    /**
     * Test BlowingSnow value.
     *
     * @return void
     */
    public function testBlowingSnow(): void
    {
        $data = WeatherCondition::fromName(case: 'BlowingSnow');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'BlowingSnow', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Blowing snow', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌬', actual: $data->asEmoji());
    }

    /**
     * Test Foggy value.
     *
     * @return void
     */
    public function testFoggy(): void
    {
        $data = WeatherCondition::fromName(case: 'Foggy');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Foggy', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Foggy', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌫', actual: $data->asEmoji());
    }

    /**
     * Test Smoky value.
     *
     * @return void
     */
    public function testSmoky(): void
    {
        $data = WeatherCondition::fromName(case: 'Smoky');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Smoky', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Smoky', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🌫', actual: $data->asEmoji());
    }

    /**
     * Test Frigid value.
     *
     * @return void
     */
    public function testFrigid(): void
    {
        $data = WeatherCondition::fromName(case: 'Frigid');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Frigid', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Frigid', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🥶', actual: $data->asEmoji());
    }

    /**
     * Test Hot value.
     *
     * @return void
     */
    public function testHot(): void
    {
        $data = WeatherCondition::fromName(case: 'Hot');

        $this->assertIsString(actual: $data->name);
        $this->assertEquals(expected: 'Hot', actual: $data->name);
        $this->assertIsString(actual: $data->value);
        $this->assertEquals(expected: 'Hot', actual: $data->value);

        $this->assertIsString(actual: $data->asEmoji());
        $this->assertEquals(expected: '🥵', actual: $data->asEmoji());
    }
}
