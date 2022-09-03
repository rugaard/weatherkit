<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Measurements;

use Rugaard\WeatherKit\DTO\Measurements\Pressure;
use Rugaard\WeatherKit\Enums\Pressure as PressureTrend;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Units\Pressure\Bar;
use Rugaard\WeatherKit\Units\Pressure\Hectopascal;
use Rugaard\WeatherKit\Units\Pressure\KilogramForcePerSquareCentimeter;
use Rugaard\WeatherKit\Units\Pressure\KilogramForcePerSquareMeter;
use Rugaard\WeatherKit\Units\Pressure\Millibar;
use Rugaard\WeatherKit\Units\Pressure\Pascal;

/**
 * PressureTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Measurements
 */
class PressureTest extends AbstractTestCase
{
    /**
     * Pressure measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\Pressure
     */
    protected Pressure $data;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new Pressure(data: ['value' => 1028.31, 'trend' => 'steady']);
    }

    /**
     * Test value.
     *
     * @return void
     */
    public function testValue(): void
    {
        $this->assertIsFloat(actual: $this->data->getValue());
        $this->assertEquals(expected: 1028.31, actual: $this->data->getValue());
    }

    /**
     * Test trend value.
     *
     * @return void
     */
    public function testTrend(): void
    {
        $this->assertInstanceOf(expected: PressureTrend::class, actual: $this->data->getTrend());
        $this->assertEquals(expected: 'Steady', actual: $this->data->getTrend()->name);
        $this->assertEquals(expected: 'steady', actual: $this->data->getTrend()->value);
    }

    /**
     * Test unit.
     *
     * @return void
     */
    public function testUnit(): void
    {
        $this->assertInstanceOf(expected: Millibar::class, actual: $this->data->getUnit());
    }

    /**
     * Test __toString.
     *
     * @return void
     */
    public function testToString(): void
    {
        $this->assertEquals(expected: '1028.31 mbar', actual: (string) $this->data);
    }

    /**
     * Test conversion: millibar to bar.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillibarToBar(): void
    {
        $data = (clone $this->data)->asBars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.0283099999999998, actual: $data->getValue());
        $this->assertInstanceOf(expected: Bar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.02831 bar', actual: (string) $data);
    }

    /**
     * Test conversion: millibar to hectopascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillibarToHectopascal(): void
    {
        $data = (clone $this->data)->asHectopascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Hectopascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.31 hPa', actual: (string) $data);
    }

    /**
     * Test conversion: millibar to Kilogram-force per square centimeter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillibarToKilogramForcePerSquareCentimeter(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareCentimeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.0488762, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareCentimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.0488762 kgf/cm²', actual: (string) $data);
    }

    /**
     * Test conversion: millibar to Kilogram-force per square meter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillibarToKilogramForcePerSquareMeter(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareMeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 10485.84365622, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareMeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '10485.84365622 kgf/m²', actual: (string) $data);
    }

    /**
     * Test conversion: millibar to millibar.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillibarToMillibar(): void
    {
        $data = (clone $this->data)->asMillibars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millibar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.31 mbar', actual: (string) $data);
    }

    /**
     * Test conversion: millibar to pascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillibarToPascal(): void
    {
        $data = (clone $this->data)->asPascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 102831.0, actual: $data->getValue());
        $this->assertInstanceOf(expected: Pascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '102831 Pa', actual: (string) $data);
    }

    /**
     * Test conversion: bar to hectopascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testBarToHectopascal(): void
    {
        $data = (clone $this->data)->asBars()->asHectopascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Hectopascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.31 hPa', actual: (string) $data);
    }

    /**
     * Test conversion: bar to Kilogram-force per square centimeter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testBarToKilogramForcePerSquareCentimeter(): void
    {
        $data = (clone $this->data)->asBars()->asKilogramForcePerSquareCentimeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.0485841599599999, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareCentimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.04858415996 kgf/cm²', actual: (string) $data);
    }

    /**
     * Test conversion: bar to Kilogram-force per square meter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testBarToKilogramForcePerSquareMeter(): void
    {
        $data = (clone $this->data)->asBars()->asKilogramForcePerSquareMeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 10485.843789900298, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareMeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '10485.8437899 kgf/m²', actual: (string) $data);
    }

    /**
     * Test conversion: bar to millibars.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testBarToMillibars(): void
    {
        $data = (clone $this->data)->asBars()->asMillibars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millibar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.31 mbar', actual: (string) $data);
    }

    /**
     * Test conversion: bar to pascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testBarToPascal(): void
    {
        $data = (clone $this->data)->asBars()->asPascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 102830.99999999999, actual: $data->getValue());
        $this->assertInstanceOf(expected: Pascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '102831 Pa', actual: (string) $data);
    }

    /**
     * Test conversion: hectopascal to bar.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testHectopascalToBar(): void
    {
        $data = (clone $this->data)->asHectopascal()->asBars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.0283099999999998, actual: $data->getValue());
        $this->assertInstanceOf(expected: Bar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.02831 bar', actual: (string) $data);
    }

    /**
     * Test conversion: hectopascal to Kilogram-force per square centimeter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testHectopascalToKilogramForcePerSquareCentimeter(): void
    {
        $data = (clone $this->data)->asHectopascal()->asKilogramForcePerSquareCentimeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.0488762, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareCentimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.0488762 kgf/cm²', actual: (string) $data);
    }

    /**
     * Test conversion: hectopascal to Kilogram-force per square meter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testHectopascalToKilogramForcePerSquareMeter(): void
    {
        $data = (clone $this->data)->asHectopascal()->asKilogramForcePerSquareMeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 10485.84365622, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareMeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '10485.84365622 kgf/m²', actual: (string) $data);
    }

    /**
     * Test conversion: hectopascal to millibar.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testHectopascalToMillibar(): void
    {
        $data = (clone $this->data)->asHectopascal()->asMillibars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millibar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.31 mbar', actual: (string) $data);
    }

    /**
     * Test conversion: hectopascal to pascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testHectopascalToPascal(): void
    {
        $data = (clone $this->data)->asHectopascal()->asPascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 102831.0, actual: $data->getValue());
        $this->assertInstanceOf(expected: Pascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '102831 Pa', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square centimeter to bar.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareCentimeterToBar(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareCentimeter()->asBars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.028596178673, actual: $data->getValue());
        $this->assertInstanceOf(expected: Bar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.028596178673 bar', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square centimeter to hectopascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareCentimeterToHectopascal(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareCentimeter()->asHectopascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.596178673, actual: $data->getValue());
        $this->assertInstanceOf(expected: Hectopascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.596178673 hPa', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square centimeter to Kilogram-force per square meter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareCentimeterToKilogramsPerSquareToMeter(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareCentimeter()->asKilogramForcePerSquareMeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 10488.762, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareMeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '10488.762 kgf/m²', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square centimeter to millibars.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareCentimeterToMillibars(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareCentimeter()->asMillibars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.596178673, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millibar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.596178673 mbar', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square centimeter to pascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareCentimeterToPascal(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareCentimeter()->asPascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 102859.61786730001, actual: $data->getValue());
        $this->assertInstanceOf(expected: Pascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '102859.6178673 Pa', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square meter to bar.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareMeterToBar(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareMeter()->asBars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.0283152298345268, actual: $data->getValue());
        $this->assertInstanceOf(expected: Bar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.0283152298345 bar', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square meter to hectopascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareMeterToHectopascal(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareMeter()->asHectopascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.3152298345267, actual: $data->getValue());
        $this->assertInstanceOf(expected: Hectopascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.3152298345 hPa', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square meter to Kilogram-force per square centimeter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareMeterToKilogramsPerSquareToCentimeter(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareMeter()->asKilogramForcePerSquareCentimeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.048584365622, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareCentimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.048584365622 kgf/cm²', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square meter to millibars.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareMeterToMillibars(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareMeter()->asMillibars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.3152298345267, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millibar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.3152298345 mbar', actual: (string) $data);
    }

    /**
     * Test conversion: Kilogram-force per square meter to pascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilogramForcePerSquareMeterToPascal(): void
    {
        $data = (clone $this->data)->asKilogramForcePerSquareMeter()->asPascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 102830.99869126987, actual: $data->getValue());
        $this->assertInstanceOf(expected: Pascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '102830.99869127 Pa', actual: (string) $data);
    }

    /**
     * Test conversion: pascal to bars.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testPascalToBars(): void
    {
        $data = (clone $this->data)->asPascal()->asBars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.02831, actual: $data->getValue());
        $this->assertInstanceOf(expected: Bar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.02831 bar', actual: (string) $data);
    }

    /**
     * Test conversion: pascal to hectopascal.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testPascalToHectopascal(): void
    {
        $data = (clone $this->data)->asPascal()->asHectopascal();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Hectopascal::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.31 hPa', actual: (string) $data);
    }

    /**
     * Test conversion: pascal to Kilogram-force per square centimeter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testPascalToKilogramForcePerSquareCentimeter(): void
    {
        $data = (clone $this->data)->asPascal()->asKilogramForcePerSquareCentimeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.0485677070000001, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareCentimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.048567707 kgf/cm²', actual: (string) $data);
    }

    /**
     * Test conversion: pascal to Kilogram-force per square meter.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testPascalToKilogramForcePerSquareMeter(): void
    {
        $data = (clone $this->data)->asPascal()->asKilogramForcePerSquareMeter();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 10485.882732, actual: $data->getValue());
        $this->assertInstanceOf(expected: KilogramForcePerSquareMeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '10485.882732 kgf/m²', actual: (string) $data);
    }

    /**
     * Test conversion: pascal to millibars.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testPascalToMillibars(): void
    {
        $data = (clone $this->data)->asPascal()->asMillibars();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1028.31, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millibar::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1028.31 mbar', actual: (string) $data);
    }
}
