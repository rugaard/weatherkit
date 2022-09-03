<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Measurements;

use Rugaard\WeatherKit\DTO\Measurements\Visibility;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Units\Length\Centimeter;
use Rugaard\WeatherKit\Units\Length\Foot;
use Rugaard\WeatherKit\Units\Length\Inch;
use Rugaard\WeatherKit\Units\Length\Kilometer;
use Rugaard\WeatherKit\Units\Length\Meter;
use Rugaard\WeatherKit\Units\Length\Mile;
use Rugaard\WeatherKit\Units\Length\Millimeter;
use Rugaard\WeatherKit\Units\Length\Yard;

/**
 * VisibilityTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Measurements
 */
class VisibilityTest extends AbstractTestCase
{
    /**
     * Visibility measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\Visibility
     */
    protected Visibility $data;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new Visibility(data: ['value' => 28174.63]);
    }

    /**
     * Test value.
     *
     * @return void
     */
    public function testValue(): void
    {
        $this->assertIsFloat(actual: $this->data->getValue());
        $this->assertEquals(expected: 28174.63, actual: $this->data->getValue());
    }

    /**
     * Test unit.
     *
     * @return void
     */
    public function testUnit(): void
    {
        $this->assertInstanceOf(expected: Meter::class, actual: $this->data->getUnit());
    }

    /**
     * Test __toString.
     *
     * @return void
     */
    public function testToString(): void
    {
        $this->assertEquals(expected: '28174.63 m', actual: (string) $this->data);
    }

    /**
     * Test conversion: meters to centimeters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToCentimeters(): void
    {
        $data = (clone $this->data)->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2817463.0, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2817463 cm', actual: (string) $data);
    }

    /**
     * Test conversion: meters to feet.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToFeet(): void
    {
        $data = (clone $this->data)->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 92436.4530892, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '92436.4530892 ft', actual: (string) $data);
    }

    /**
     * Test conversion: meters to inches.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToInches(): void
    {
        $data = (clone $this->data)->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1109237.4088957699, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1109237.4088958 in', actual: (string) $data);
    }

    /**
     * Test conversion: meters to kilometers.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToKilometers(): void
    {
        $data = (clone $this->data)->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.17463, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.17463 km', actual: (string) $data);
    }

    /**
     * Test conversion: meters to meters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToMeters(): void
    {
        $data = (clone $this->data)->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174.63, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174.63 m', actual: (string) $data);
    }

    /**
     * Test conversion: meters to miles.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToMiles(): void
    {
        $data = (clone $this->data)->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 17.496445230000003, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '17.49644523 mi', actual: (string) $data);
    }

    /**
     * Test conversion: meters to millimeters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToMillimeters(): void
    {
        $data = (clone $this->data)->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174630.0, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174630 mm', actual: (string) $data);
    }

    /**
     * Test conversion: meters to yards.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToYards(): void
    {
        $data = (clone $this->data)->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 30812.141638189998, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '30812.14163819 yd', actual: (string) $data);
    }

    /**
     * Test conversion: centimeters to feet.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCentimetersToFeet(): void
    {
        $data = (clone $this->data)->asCentimeters()->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 92436.45013123359, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '92436.450131234 ft', actual: (string) $data);
    }

    /**
     * Test conversion: centimeters to inches.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCentimetersToInches(): void
    {
        $data = (clone $this->data)->asCentimeters()->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1109237.401574803, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1109237.4015748 in', actual: (string) $data);
    }

    /**
     * Test conversion: centimeters to kilometers.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCentimetersToKilometers(): void
    {
        $data = (clone $this->data)->asCentimeters()->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.17463, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.17463 km', actual: (string) $data);
    }

    /**
     * Test conversion: centimeters to meters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCentimetersToMeters(): void
    {
        $data = (clone $this->data)->asCentimeters()->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174.63, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174.63 m', actual: (string) $data);
    }

    /**
     * Test conversion: centimeters to miles.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCentimetersToMiles(): void
    {
        $data = (clone $this->data)->asCentimeters()->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.75068698431E-7, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.75068698431E-7 mi', actual: (string) $data);
    }

    /**
     * Test conversion: centimeters to millimeters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCentimetersToMillimeters(): void
    {
        $data = (clone $this->data)->asCentimeters()->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174630.0, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174630 mm', actual: (string) $data);
    }

    /**
     * Test conversion: centimeters to yards.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testCentimetersToYards(): void
    {
        $data = (clone $this->data)->asCentimeters()->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 30811.775368, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '30811.775368 yd', actual: (string) $data);
    }

    /**
     * Test conversion: feet to centimeters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFeetToCentimeters(): void
    {
        $data = (clone $this->data)->asFeet()->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2817463.090158816, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2817463.0901588 cm', actual: (string) $data);
    }

    /**
     * Test conversion: feet to inches.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFeetToInches(): void
    {
        $data = (clone $this->data)->asFeet()->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1109237.4370704, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1109237.4370704 in', actual: (string) $data);
    }

    /**
     * Test conversion: feet to kilometers.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFeetToKilometers(): void
    {
        $data = (clone $this->data)->asFeet()->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.193118192206, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.193118192206 km', actual: (string) $data);
    }

    /**
     * Test conversion: feet to meters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFeetToMeters(): void
    {
        $data = (clone $this->data)->asFeet()->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174.630901588163, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174.630901588 m', actual: (string) $data);
    }

    /**
     * Test conversion: feet to miles.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFeetToMiles(): void
    {
        $data = (clone $this->data)->asFeet()->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 17.506903994166667, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '17.506903994167 mi', actual: (string) $data);
    }

    /**
     * Test conversion: feet to millimeters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFeetToMillimeters(): void
    {
        $data = (clone $this->data)->asFeet()->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174630.90158816, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174630.901588 mm', actual: (string) $data);
    }

    /**
     * Test conversion: feet to yards.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testFeetToYards(): void
    {
        $data = (clone $this->data)->asFeet()->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 30812.151029733333, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '30812.151029733 yd', actual: (string) $data);
    }

    /**
     * Test conversion: inches to centimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testInchesToCentimeters(): void
    {
        $data = (clone $this->data)->asInches()->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2817463.0185952554, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2817463.0185953 cm', actual: (string) $data);
    }

    /**
     * Test conversion: inches to centimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testInchesToFeet(): void
    {
        $data = (clone $this->data)->asInches()->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 92436.45074131415, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '92436.450741314 ft', actual: (string) $data);
    }

    /**
     * Test conversion: inches to kilometers
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testInchesToKilometers(): void
    {
        $data = (clone $this->data)->asInches()->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.174630185952555, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.174630185953 km', actual: (string) $data);
    }

    /**
     * Test conversion: inches to meters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testInchesToMeters(): void
    {
        $data = (clone $this->data)->asInches()->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174.630185952552, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174.630185953 m', actual: (string) $data);
    }

    /**
     * Test conversion: inches to millimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testInchesToMillimeters(): void
    {
        $data = (clone $this->data)->asInches()->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174630.18595255, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174630.185953 mm', actual: (string) $data);
    }

    /**
     * Test conversion: inches to miles
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testInchesToMiles(): void
    {
        $data = (clone $this->data)->asInches()->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 17.506903549491316, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '17.506903549491 mi', actual: (string) $data);
    }

    /**
     * Test conversion: inches to yards
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testInchesToYards(): void
    {
        $data = (clone $this->data)->asInches()->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 30812.150247104717, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '30812.150247105 yd', actual: (string) $data);
    }

    /**
     * Test conversion: kilometers to centimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometersToCentimeters(): void
    {
        $data = (clone $this->data)->asKilometers()->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2817463.0, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2817463 cm', actual: (string) $data);
    }

    /**
     * Test conversion: kilometers to feet
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometersToFeet(): void
    {
        $data = (clone $this->data)->asKilometers()->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 92436.45013086386, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '92436.450130864 ft', actual: (string) $data);
    }

    /**
     * Test conversion: kilometers to inches
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometersToInches(): void
    {
        $data = (clone $this->data)->asKilometers()->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1109237.4015703662, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1109237.4015704 in', actual: (string) $data);
    }

    /**
     * Test conversion: kilometers to meters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometersToMeters(): void
    {
        $data = (clone $this->data)->asKilometers()->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174.63, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174.63 m', actual: (string) $data);
    }

    /**
     * Test conversion: kilometers to miles
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometersToMiles(): void
    {
        $data = (clone $this->data)->asKilometers()->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 17.506898017730002, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '17.50689801773 mi', actual: (string) $data);
    }

    /**
     * Test conversion: kilometers to millimeter
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometersToMillimeters(): void
    {
        $data = (clone $this->data)->asKilometers()->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.817463E-5, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.817463E-5 mm', actual: (string) $data);
    }

    /**
     * Test conversion: kilometers to yards
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testKilometersToYards(): void
    {
        $data = (clone $this->data)->asKilometers()->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 30812.15003422974, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '30812.15003423 yd', actual: (string) $data);
    }

    /**
     * Test conversion: miles to centimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilesToCentimeters(): void
    {
        $data = (clone $this->data)->asMiles()->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2815779.915222912, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2815779.9152229 cm', actual: (string) $data);
    }

    /**
     * Test conversion: miles to feet
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilesToFeet(): void
    {
        $data = (clone $this->data)->asMiles()->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 92381.23081440001, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '92381.2308144 ft', actual: (string) $data);
    }

    /**
     * Test conversion: miles to inches
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilesToInches(): void
    {
        $data = (clone $this->data)->asMiles()->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1108574.7697728002, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1108574.7697728 in', actual: (string) $data);
    }

    /**
     * Test conversion: miles to kilometers
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilesToKilometers(): void
    {
        $data = (clone $this->data)->asMiles()->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.157799152229128, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.157799152229 km', actual: (string) $data);
    }

    /**
     * Test conversion: miles to meters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilesToMeters(): void
    {
        $data = (clone $this->data)->asMiles()->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28157.799152229127, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28157.799152229 m', actual: (string) $data);
    }

    /**
     * Test conversion: miles to millimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilesToMillimeters(): void
    {
        $data = (clone $this->data)->asMiles()->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28157799.152229123, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28157799.152229 mm', actual: (string) $data);
    }

    /**
     * Test conversion: miles to yards
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMilesToYards(): void
    {
        $data = (clone $this->data)->asMiles()->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 30793.743604800005, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '30793.7436048 yd', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to centimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToCentimeters(): void
    {
        $data = (clone $this->data)->asMillimeters()->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2817463.0, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2817463 cm', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to feet
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToFeet(): void
    {
        $data = (clone $this->data)->asMillimeters()->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 92440.96103, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '92440.96103 ft', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to inches
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToInches(): void
    {
        $data = (clone $this->data)->asMillimeters()->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1109237.4015748033, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1109237.4015748 in', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to kilometers
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToKilometers(): void
    {
        $data = (clone $this->data)->asMillimeters()->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.17463, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.17463 km', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to meters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToMeters(): void
    {
        $data = (clone $this->data)->asMillimeters()->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174.63, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174.63 m', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to miles
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToMiles(): void
    {
        $data = (clone $this->data)->asMillimeters()->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 17.506903433945755, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '17.506903433946 mi', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to yards
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToYards(): void
    {
        $data = (clone $this->data)->asMillimeters()->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 30823.045219999996, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '30823.04522 yd', actual: (string) $data);
    }

    /**
     * Test conversion: yards to centimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testYardsToCentimeters(): void
    {
        $data = (clone $this->data)->asYards()->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2817462.2313960935, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2817462.2313961 cm', actual: (string) $data);
    }

    /**
     * Test conversion: yards to feet
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testYardsToFeet(): void
    {
        $data = (clone $this->data)->asYards()->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 92436.42491457, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '92436.42491457 ft', actual: (string) $data);
    }

    /**
     * Test conversion: yards to inches
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testYardsToInches(): void
    {
        $data = (clone $this->data)->asYards()->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1109237.09897484, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1109237.0989748 in', actual: (string) $data);
    }

    /**
     * Test conversion: yards to kilometers
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testYardsToKilometers(): void
    {
        $data = (clone $this->data)->asYards()->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28.16229745730566, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28.162297457306 km', actual: (string) $data);
    }

    /**
     * Test conversion: yards to meters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testYardsToMeters(): void
    {
        $data = (clone $this->data)->asYards()->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174.622313960936, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174.622313961 m', actual: (string) $data);
    }

    /**
     * Test conversion: yards to miles
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testYardsToMiles(): void
    {
        $data = (clone $this->data)->asYards()->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 17.5068986580625, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '17.506898658063 mi', actual: (string) $data);
    }

    /**
     * Test conversion: yards to millimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testYardsToMillimeters(): void
    {
        $data = (clone $this->data)->asYards()->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 28174622.313960932, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '28174622.313961 mm', actual: (string) $data);
    }
}
