<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Enums;

use Rugaard\WeatherKit\Enums\Action;
use Rugaard\WeatherKit\Tests\AbstractTestCase;

/**
 * ActionTest.
 *
 * @package Rugaard\WeatherKit\Tests\Enums
 */
class ActionTest extends AbstractTestCase
{
    /**
     * Test allClear value.
     *
     * @return void
     */
    public function testAllClear(): void
    {
        $data = Action::from(value: 'allClear');

        $this->assertEquals(expected: 'AllClear', actual: $data->name);
        $this->assertEquals(expected: 'allClear', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'The event no longer poses a threat', actual: $data->description());
    }

    /**
     * Test Assess value.
     *
     * @return void
     */
    public function testAssess(): void
    {
        $data = Action::from(value: 'assess');

        $this->assertEquals(expected: 'Assess', actual: $data->name);
        $this->assertEquals(expected: 'assess', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Assess the situation', actual: $data->description());
    }

    /**
     * Test Avoid value.
     *
     * @return void
     */
    public function testAvoid(): void
    {
        $data = Action::from(value: 'avoid');

        $this->assertEquals(expected: 'Avoid', actual: $data->name);
        $this->assertEquals(expected: 'avoid', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Avoid the event', actual: $data->description());
    }

    /**
     * Test Evacuate value.
     *
     * @return void
     */
    public function testEvacuate(): void
    {
        $data = Action::from(value: 'evacuate');

        $this->assertEquals(expected: 'Evacuate', actual: $data->name);
        $this->assertEquals(expected: 'evacuate', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Relocate', actual: $data->description());
    }

    /**
     * Test Execute value.
     *
     * @return void
     */
    public function testExecute(): void
    {
        $data = Action::from(value: 'execute');

        $this->assertEquals(expected: 'Execute', actual: $data->name);
        $this->assertEquals(expected: 'execute', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Execute a pre-planned activity', actual: $data->description());
    }

    /**
     * Test Monitor value.
     *
     * @return void
     */
    public function testMonitor(): void
    {
        $data = Action::from(value: 'monitor');

        $this->assertEquals(expected: 'Monitor', actual: $data->name);
        $this->assertEquals(expected: 'monitor', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Monitor the situation', actual: $data->description());
    }

    /**
     * Test None value.
     *
     * @return void
     */
    public function testNone(): void
    {
        $data = Action::from(value: 'none');

        $this->assertEquals(expected: 'None', actual: $data->name);
        $this->assertEquals(expected: 'none', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'No action recommended', actual: $data->description());
    }

    /**
     * Test Prepare value.
     *
     * @return void
     */
    public function testPrepare(): void
    {
        $data = Action::from(value: 'prepare');

        $this->assertEquals(expected: 'Prepare', actual: $data->name);
        $this->assertEquals(expected: 'prepare', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Make preparations', actual: $data->description());
    }

    /**
     * Test Shelter value.
     *
     * @return void
     */
    public function testShelter(): void
    {
        $data = Action::from(value: 'shelter');

        $this->assertEquals(expected: 'Shelter', actual: $data->name);
        $this->assertEquals(expected: 'shelter', actual: $data->value);

        $this->assertIsString(actual: $data->description());
        $this->assertEquals(expected: 'Take shelter in place', actual: $data->description());
    }
}
