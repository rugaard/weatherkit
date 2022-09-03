<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Measurements;

use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
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
 * PrecipitationTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Measurements
 */
class PrecipitationTest extends AbstractTestCase
{
    /**
     * Precipitation measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\Precipitation
     */
    protected Precipitation $data;

    /**
     * Set up test case.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->data = new Precipitation(data: ['value' => 2.87]);
    }

    /**
     * Test value.
     *
     * @return void
     */
    public function testValue(): void
    {
        $this->assertIsFloat(actual: $this->data->getValue());
        $this->assertEquals(expected: 2.87, actual: $this->data->getValue());
    }

    /**
     * Test unit.
     *
     * @return void
     */
    public function testUnit(): void
    {
        $this->assertInstanceOf(expected: Millimeter::class, actual: $this->data->getUnit());
    }

    /**
     * Test __toString.
     *
     * @return void
     */
    public function testToString(): void
    {
        $this->assertEquals(expected: '2.87 mm', actual: (string) $this->data);
    }

    /**
     * Test conversion: millimeters to centimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToCentimeters(): void
    {
        $data = (clone $this->data)->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.28700000000000003, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.287 cm', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to feet
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToFeet(): void
    {
        $data = (clone $this->data)->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.00941647, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00941647 ft', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to inches
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToInches(): void
    {
        $data = (clone $this->data)->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.11299212598425198, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.11299212598425 in', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to kilometers
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToKilometers(): void
    {
        $data = (clone $this->data)->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.87E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87E-6 km', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to meters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToMeters(): void
    {
        $data = (clone $this->data)->asMeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.00287, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00287 m', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to millimeters
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToMillimeters(): void
    {
        $data = (clone $this->data)->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.87, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87 mm', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to miles
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToMiles(): void
    {
        $data = (clone $this->data)->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.7833353217211487E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.7833353217211E-6 mi', actual: (string) $data);
    }

    /**
     * Test conversion: millimeters to yards
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMillimetersToYards(): void
    {
        $data = (clone $this->data)->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.00313978, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00313978 yd', actual: (string) $data);
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
        $this->assertEquals(expected: 0.009416010498687665, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0094160104986877 ft', actual: (string) $data);
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
        $this->assertEquals(expected: 0.11299212598425198, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.11299212598425 in', actual: (string) $data);
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
        $this->assertEquals(expected: 2.8700000000000005E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87E-6 km', actual: (string) $data);
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
        $this->assertEquals(expected: 0.00287, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00287 m', actual: (string) $data);
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
        $this->assertEquals(expected: 1.7833319E-14, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.7833319E-14 mi', actual: (string) $data);
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
        $this->assertEquals(expected: 2.87, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87 mm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.003138632, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.003138632 yd', actual: (string) $data);
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
        $this->assertEquals(expected: 0.2870140056, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.2870140056 cm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.11299764, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.11299764 in', actual: (string) $data);
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
        $this->assertEquals(expected: 2.87202335E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87202335E-6 km', actual: (string) $data);
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
        $this->assertEquals(expected: 0.002870140056, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.002870140056 m', actual: (string) $data);
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
        $this->assertEquals(expected: 1.7834223484848483E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.7834223484848E-6 mi', actual: (string) $data);
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
        $this->assertEquals(expected: 2.870140056, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.870140056 mm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.0031388233333333334, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0031388233333333 yd', actual: (string) $data);
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
        $this->assertEquals(expected: 0.28700000000000003, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.287 cm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.009416010498687665, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0094160104986877 ft', actual: (string) $data);
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
        $this->assertEquals(expected: 2.8700000000000005E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87E-6 km', actual: (string) $data);
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
        $this->assertEquals(expected: 0.00287, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00287 m', actual: (string) $data);
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
        $this->assertEquals(expected: 2.87, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87 mm', actual: (string) $data);
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
        $this->assertEquals(expected: 1.7833353217211487E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.7833353217211E-6 mi', actual: (string) $data);
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
        $this->assertEquals(expected: 0.003138670166229222, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0031386701662292 yd', actual: (string) $data);
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
        $this->assertEquals(expected: 0.287, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.287 cm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.00941601049865, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00941601049865 ft', actual: (string) $data);
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
        $this->assertEquals(expected: 0.1129921259838, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.1129921259838 in', actual: (string) $data);
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
        $this->assertEquals(expected: 0.00287, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00287 m', actual: (string) $data);
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
        $this->assertEquals(expected: 1.78333477E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.78333477E-6 mi', actual: (string) $data);
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
        $this->assertEquals(expected: 2.87E-12, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87E-12 mm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.0031386701652600002, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00313867016526 yd', actual: (string) $data);
    }

    /**
     * Test conversion: meters to centimeters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToCentimeters(): void
    {
        $data = (clone $this->data)->asMeters()->asCentimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.28700000000000003, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.287 cm', actual: (string) $data);
    }

    /**
     * Test conversion: meters to feet.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToFeet(): void
    {
        $data = (clone $this->data)->asMeters()->asFeet();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.009416010800000001, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0094160108 ft', actual: (string) $data);
    }

    /**
     * Test conversion: meters to inches.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToInches(): void
    {
        $data = (clone $this->data)->asMeters()->asInches();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.11299212673, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.11299212673 in', actual: (string) $data);
    }

    /**
     * Test conversion: meters to kilometers.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToKilometers(): void
    {
        $data = (clone $this->data)->asMeters()->asKilometers();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.87E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87E-6 km', actual: (string) $data);
    }

    /**
     * Test conversion: meters to miles.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToMiles(): void
    {
        $data = (clone $this->data)->asMeters()->asMiles();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 1.78227E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.78227E-6 mi', actual: (string) $data);
    }

    /**
     * Test conversion: meters to millimeters.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToMillimeters(): void
    {
        $data = (clone $this->data)->asMeters()->asMillimeters();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 2.87, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87 mm', actual: (string) $data);
    }

    /**
     * Test conversion: meters to yards.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\UnsupportedUnitConversion
     */
    public function testMetersToYards(): void
    {
        $data = (clone $this->data)->asMeters()->asYards();

        $this->assertIsFloat(actual: $data->getValue());
        $this->assertEquals(expected: 0.00313866931, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00313866931 yd', actual: (string) $data);
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
        $this->assertEquals(expected: 0.28700000000000003, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.287 cm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.009416010498687665, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0094160104986877 ft', actual: (string) $data);
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
        $this->assertEquals(expected: 0.11299212598425198, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.11299212598425 in', actual: (string) $data);
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
        $this->assertEquals(expected: 2.8700000000000005E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87E-6 km', actual: (string) $data);
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
        $this->assertEquals(expected: 0.00287, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00287 m', actual: (string) $data);
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
        $this->assertEquals(expected: 2.87, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.87 mm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.0031386701662292214, actual: $data->getValue());
        $this->assertInstanceOf(expected: Yard::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.0031386701662292 yd', actual: (string) $data);
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
        $this->assertEquals(expected: 0.2871014832, actual: $data->getValue());
        $this->assertInstanceOf(expected: Centimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.2871014832 cm', actual: (string) $data);
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
        $this->assertEquals(expected: 0.00941934, actual: $data->getValue());
        $this->assertInstanceOf(expected: Foot::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.00941934 ft', actual: (string) $data);
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
        $this->assertEquals(expected: 0.11303208000000001, actual: $data->getValue());
        $this->assertInstanceOf(expected: Inch::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.11303208 in', actual: (string) $data);
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
        $this->assertEquals(expected: 2.86975892E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Kilometer::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.86975892E-6 km', actual: (string) $data);
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
        $this->assertEquals(expected: 0.002871014832, actual: $data->getValue());
        $this->assertInstanceOf(expected: Meter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '0.002871014832 m', actual: (string) $data);
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
        $this->assertEquals(expected: 1.7839659090909092E-6, actual: $data->getValue());
        $this->assertInstanceOf(expected: Mile::class, actual: $data->getUnit());
        $this->assertEquals(expected: '1.7839659090909E-6 mi', actual: (string) $data);
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
        $this->assertEquals(expected: 2.8710148319999997, actual: $data->getValue());
        $this->assertInstanceOf(expected: Millimeter::class, actual: $data->getUnit());
        $this->assertEquals(expected: '2.871014832 mm', actual: (string) $data);
    }
}
