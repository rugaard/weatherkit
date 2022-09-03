<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Measurements;

use Rugaard\WeatherKit\DTO\Measurements\Wind;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Units\Speed\FootPerSecond;
use Rugaard\WeatherKit\Units\Speed\KilometerPerHour;
use Rugaard\WeatherKit\Units\Speed\KilometerPerSecond;
use Rugaard\WeatherKit\Units\Speed\Knot;
use Rugaard\WeatherKit\Units\Speed\MeterPerSecond;
use Rugaard\WeatherKit\Units\Speed\MilePerHour;

/**
 * WindTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Measurements
 */
class WindTest extends AbstractTestCase
{
    /**
     * Wind measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\Wind
     */
    protected Wind $data;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new Wind(data: ['value' => 5.41]);
    }

    /**
     * Test value.
     *
     * @return void
     */
    public function testValue(): void
    {
        $this->assertIsFloat(actual: $this->data->getValue());
        $this->assertEquals(expected: 5.41, actual: $this->data->getValue());
    }

    /**
     * Test unit.
     *
     * @return void
     */
    public function testUnit(): void
    {
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $this->data->getUnit());
    }

    /**
     * Test __toString.
     *
     * @return void
     */
    public function testToString(): void
    {
        $this->assertEquals(expected: '5.41 km/h', actual: (string) $this->data);
    }

    /**
     * Test conversion: Kilometer per hour to Foot per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerHourToFootPerSecond(): void
    {
        $data = (clone $this->data)->asFootPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 4.930371040000001, actual: $data->getValue());
        $this->assertInstanceOf(expected: FootPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '4.93037104 ft/s', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per hour to Kilometer per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerHourToKilometerPerHour(): void
    {
        $data = (clone $this->data)->asKilometerPerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 5.41, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '5.41 km/h', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per hour to Kilometer per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerHourToKilometerPerSecond(): void
    {
        $data = (clone $this->data)->asKilometerPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.00165005, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00165005 km/s', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per hour to Knot.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerHourToKnot(): void
    {
        $data = (clone $this->data)->asKnot();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.92116737, actual: $data->getValue());
        $this->assertInstanceOf(expected: Knot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.92116737 kn', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per hour to Meter per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerHourToMeterPerSecond(): void
    {
        $data = (clone $this->data)->asMeterPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.5027789800000002, actual: $data->getValue());
        $this->assertInstanceOf(expected: MeterPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.50277898 m/s', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per hour to Mile per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerHourToMilePerHour(): void
    {
        $data = (clone $this->data)->asMilePerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 3.361618150003977, actual: $data->getValue());
        $this->assertInstanceOf(expected: MilePerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '3.361618150004 mph', actual: (string) $data);
    }

    /**
     * Test conversion: Foot per second to Kilometer per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFootPerSecondToKilometerPerSecond(): void
    {
        $data = (clone $this->data)->asFootPerSecond()->asKilometerPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.0015037631672000001, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0015037631672 km/s', actual: (string) $data);
    }

    /**
     * Test conversion: Foot per second to Kilometer per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFootPerSecondToKilometerPerHour(): void
    {
        $data = (clone $this->data)->asFootPerSecond()->asKilometerPerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 5.4099975347712, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '5.4099975347712 km/h', actual: (string) $data);
    }

    /**
     * Test conversion: Foot per second to Knot.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFootPerSecondToKnot(): void
    {
        $data = (clone $this->data)->asFootPerSecond()->asKnot();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.9211659552633606, actual: $data->getValue());
        $this->assertInstanceOf(expected: Knot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.9211659552634 kn', actual: (string) $data);
    }

    /**
     * Test conversion: Foot per second to Meter per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFootPerSecondToMeterPerSecond(): void
    {
        $data = (clone $this->data)->asFootPerSecond()->asMeterPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.5027770929920004, actual: $data->getValue());
        $this->assertInstanceOf(expected: MeterPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.502777092992 m/s', actual: (string) $data);
    }

    /**
     * Test conversion: Foot per second to Mile per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFootPerSecondToMilePerHour(): void
    {
        $data = (clone $this->data)->asFootPerSecond()->asMilePerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 3.3616157217507205, actual: $data->getValue());
        $this->assertInstanceOf(expected: MilePerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '3.3616157217507 mph', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per second to Foot per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerSecondToFootPerSecond(): void
    {
        $data = (clone $this->data)->asKilometerPerSecond()->asFootPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 5.41354986874475, actual: $data->getValue());
        $this->assertInstanceOf(expected: FootPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '5.4135498687447 ft/s', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per second to Kilometer per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerSecondToKilometerPerHour(): void
    {
        $data = (clone $this->data)->asKilometerPerSecond()->asKilometerPerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 5.94018, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '5.94018 km/h', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per second to Knot.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerSecondToKnot(): void
    {
        $data = (clone $this->data)->asKilometerPerSecond()->asKnot();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 3.2074406040245997, actual: $data->getValue());
        $this->assertInstanceOf(expected: Knot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '3.2074406040246 kn', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per second to Meter per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerSecondToMeterPerSecond(): void
    {
        $data = (clone $this->data)->asKilometerPerSecond()->asMeterPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.65005, actual: $data->getValue());
        $this->assertInstanceOf(expected: MeterPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.65005 m/s', actual: (string) $data);
    }

    /**
     * Test conversion: Kilometer per second to Mile per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometerPerSecondToMilePerHour(): void
    {
        $data = (clone $this->data)->asKilometerPerSecond()->asMilePerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 3.6910567286145994, actual: $data->getValue());
        $this->assertInstanceOf(expected: MilePerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '3.6910567286146 mph', actual: (string) $data);
    }

    /**
     * Test conversion: Knot to Foot per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKnotToFootPerSecond(): void
    {
        $data = (clone $this->data)->asKnot()->asFootPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 4.9303754987597, actual: $data->getValue());
        $this->assertInstanceOf(expected: FootPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '4.9303754987597 ft/s', actual: (string) $data);
    }

    /**
     * Test conversion: Knot to Kilometer per second
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKnotToKilometerPerSecond(): void
    {
        $data = (clone $this->data)->asKnot()->asKilometerPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.0015014800281800001, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00150148002818 km/s', actual: (string) $data);
    }

    /**
     * Test conversion: Knot to Kilometer per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKnotToKilometerPerHour(): void
    {
        $data = (clone $this->data)->asKnot()->asKilometerPerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 5.4100019692400005, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '5.41000196924 km/h', actual: (string) $data);
    }

    /**
     * Test conversion: Knot to Meter per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKnotToMeterPerSecond(): void
    {
        $data = (clone $this->data)->asKnot()->asMeterPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.50277702649228, actual: $data->getValue());
        $this->assertInstanceOf(expected: MeterPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.5027770264923 m/s', actual: (string) $data);
    }

    /**
     * Test conversion: Knot to Mile per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKnotToMilePerHour(): void
    {
        $data = (clone $this->data)->asKnot()->asMilePerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 3.36161806488123, actual: $data->getValue());
        $this->assertInstanceOf(expected: MilePerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '3.3616180648812 mph', actual: (string) $data);
    }

    /**
     * Test conversion: Meter per second to Foot per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMeterPerSecondToFootPerSecond(): void
    {
        $data = (clone $this->data)->asMeterPerSecond()->asFootPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.3695486067491203, actual: $data->getValue());
        $this->assertInstanceOf(expected: FootPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.3695486067491 ft/s', actual: (string) $data);
    }

    /**
     * Test conversion: Meter per second to Kilometer per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMeterPerSecondToKilometerPerSecond(): void
    {
        $data = (clone $this->data)->asMeterPerSecond()->asKilometerPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.0015027789800000002, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00150277898 km/s', actual: (string) $data);
    }

    /**
     * Test conversion: Meter per second to Kilometer per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMeterPerSecondToKilometerPerHour(): void
    {
        $data = (clone $this->data)->asMeterPerSecond()->asKilometerPerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 5.410004328000001, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '5.410004328 km/h', actual: (string) $data);
    }

    /**
     * Test conversion: Meter per second to Knot.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMeterPerSecondToKnot(): void
    {
        $data = (clone $this->data)->asMeterPerSecond()->asKnot();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.92116790359912, actual: $data->getValue());
        $this->assertInstanceOf(expected: Knot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.9211679035991 kn', actual: (string) $data);
    }

    /**
     * Test conversion: Meter per second to Mile per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMeterPerSecondToMilePerHour(): void
    {
        $data = (clone $this->data)->asMeterPerSecond()->asMilePerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 3.3616204004052803, actual: $data->getValue());
        $this->assertInstanceOf(expected: MilePerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '3.3616204004053 mph', actual: (string) $data);
    }

    /**
     * Test conversion: Mile per hour to Foot per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilePerHourToFootPerSecond(): void
    {
        $data = (clone $this->data)->asMilePerHour()->asFootPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 4.9303744072118825, actual: $data->getValue());
        $this->assertInstanceOf(expected: FootPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '4.9303744072119 ft/s', actual: (string) $data);
    }

    /**
     * Test conversion: Mile per hour to Kilometer per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilePerHourToKilometerPerSecond(): void
    {
        $data = (clone $this->data)->asMilePerHour()->asKilometerPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.0015026433130517778, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0015026433130518 km/s', actual: (string) $data);
    }

    /**
     * Test conversion: Mile per hour to Kilometer per hour.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilePerHourToKilometerPerHour(): void
    {
        $data = (clone $this->data)->asMilePerHour()->asKilometerPerHour();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 5.41, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilometerPerHour::class, actual: $data->getUnit());
        $this->assertEquals(expected: '5.41 km/h', actual: (string) $data);
    }

    /**
     * Test conversion: Mile per hour to Knot.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilePerHourToKnot(): void
    {
        $data = (clone $this->data)->asMilePerHour()->asKnot();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.9211654935178557, actual: $data->getValue());
        $this->assertInstanceOf(expected: Knot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.9211654935179 kn', actual: (string) $data);
    }

    /**
     * Test conversion: Mile per hour to Meter per second.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilePerHourToMeterPerSecond(): void
    {
        $data = (clone $this->data)->asMilePerHour()->asMeterPerSecond();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.5027777777777778, actual: $data->getValue());
        $this->assertInstanceOf(expected: MeterPerSecond::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.5027777777778 m/s', actual: (string) $data);
    }
}
