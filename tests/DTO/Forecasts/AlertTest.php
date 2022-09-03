<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Forecasts;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Forecasts\Alert;
use Rugaard\WeatherKit\DTO\Source;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Action;
use Rugaard\WeatherKit\Enums\Certainty;
use Rugaard\WeatherKit\Enums\Importance;
use Rugaard\WeatherKit\Enums\Severity;
use Rugaard\WeatherKit\Enums\Urgency;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;

/**
 * AlertTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Forecasts
 */
class AlertTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Alert data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Alert
     */
    protected Alert $data;

    /**
     * Set up test case.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->data = $this->client->setClient(client: $this->mockForecastRequest())->alerts()->getData()->first();
    }

    /**
     * Test alert ID.
     *
     * @return void
     */
    public function testId(): void
    {
        $this->assertIsString(actual: $this->data->getId());
        $this->assertEquals(expected: 'd26dc1fb-da0c-52a5-9c4e-c1462ffc5f38', actual: $this->data->getId());
    }

    /**
     * Test area ID.
     *
     * @return void
     */
    public function testAreaId(): void
    {
        $this->assertIsString(actual: $this->data->getAreaId());
        $this->assertEquals(expected: 'UK116', actual: $this->data->getAreaId());
    }

    /**
     * Test area name.
     *
     * @return void
     */
    public function testAreaName(): void
    {
        $this->assertIsString(actual: $this->data->getAreaName());
        $this->assertEquals(expected: 'London & South East England', actual: $this->data->getAreaName());
    }

    /**
     * Test country code.
     *
     * @return void
     */
    public function testCountryCode(): void
    {
        $this->assertIsString(actual: $this->data->getCountryCOde());
        $this->assertEquals(expected: 'GB', actual: $this->data->getCountryCode());
    }

    /**
     * Test description.
     *
     * @return void
     */
    public function testDescription(): void
    {
        $this->assertIsString(actual: $this->data->getDescription());
        $this->assertEquals(expected: 'Moderate Thunderstorm Warning', actual: $this->data->getDescription());
    }

    /**
     * Test certainty.
     *
     * @return void
     */
    public function testCertainty(): void
    {
        $this->assertInstanceOf(expected: Certainty::class, actual: $this->data->getCertainty());
        $this->assertEquals(expected: 'Likely', actual: $this->data->getCertainty()->name);
        $this->assertEquals(expected: 'likely', actual: $this->data->getCertainty()->value);
    }

    /**
     * Test alert period.
     *
     * @return void
     */
    public function testAlertPeriod(): void
    {
        $this->assertInstanceOf(expected: TimePeriod::class, actual: $this->data->getAlertPeriod());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getAlertPeriod()->getStart());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getAlertPeriod()->getStart()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T18:04:17.000+02:00', actual: $this->data->getAlertPeriod()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getAlertPeriod()->getEnd());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getAlertPeriod()->getEnd()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-25T16:00:00.000+02:00', actual: $this->data->getAlertPeriod()->getEnd()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test event period.
     *
     * @return void
     */
    public function testEventPeriod(): void
    {
        $this->assertInstanceOf(expected: TimePeriod::class, actual: $this->data->getEventPeriod());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getEventPeriod()->getStart());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getEventPeriod()->getStart()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-25T01:00:00.000+02:00', actual: $this->data->getEventPeriod()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertNull(actual: $this->data->getEventPeriod()->getEnd());
    }

    /**
     * Test embed URL.
     *
     * @return void
     */
    public function testEmbedUrl(): void
    {
        $this->assertIsString(actual: $this->data->getEmbedUrl());
        $this->assertEquals(expected: 'https://weatherkit.apple.com/alertDetails/index.html?ids=d26dc1fb-da0c-52a5-9c4e-c1462ffc5f38&lang=en-US&timezone=Europe/Copenhagen', actual: $this->data->getEmbedUrl());
    }

    /**
     * Test importance.
     *
     * @return void
     */
    public function testImportance(): void
    {
        $this->assertInstanceOf(expected: Importance::class, actual: $this->data->getImportance());
        $this->assertEquals(expected: 'Normal', actual: $this->data->getImportance()->name);
        $this->assertEquals(expected: 'normal', actual: $this->data->getImportance()->value);
    }

    /**
     * Test importance.
     *
     * @return void
     */
    public function testIssueTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getIssuedTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getIssuedTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T18:04:17.000+02:00', actual: $this->data->getIssuedTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test precedence.
     *
     * @return void
     */
    public function testPrecedence(): void
    {
        $this->assertIsBool(actual: $this->data->getPrecedence());
        $this->assertFalse(condition: $this->data->getPrecedence());
    }

    /**
     * Test recommended actions.
     *
     * @return void
     */
    public function testRecommendedActions(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getRecommendedActions());
        $this->assertTrue(condition: $this->data->getRecommendedActions()->isNotEmpty());

        $action = $this->data->getRecommendedActions()->first();
        $this->assertInstanceOf(expected: Action::class, actual: $action);
        $this->assertEquals(expected: 'Prepare', actual: $action->name);
        $this->assertEquals(expected: 'prepare', actual: $action->value);
    }

    /**
     * Test severity.
     *
     * @return void
     */
    public function testSeverity(): void
    {
        $this->assertInstanceOf(expected: Severity::class, actual: $this->data->getSeverity());
        $this->assertEquals(expected: 'Moderate', actual: $this->data->getSeverity()->name);
        $this->assertEquals(expected: 'moderate', actual: $this->data->getSeverity()->value);
    }

    /**
     * Test source.
     *
     * @return void
     */
    public function testSource(): void
    {
        $this->assertInstanceOf(expected: Source::class, actual: $this->data->getSource());
        $this->assertEquals(expected: 'UK Met Office', actual: $this->data->getSource()->getName());
        $this->assertEquals(expected: 'EUMETNET', actual: $this->data->getSource()->getService());
    }

    /**
     * Test urgency.
     *
     * @return void
     */
    public function testUrgency(): void
    {
        $this->assertInstanceOf(expected: Urgency::class, actual: $this->data->getUrgency());
        $this->assertEquals(expected: 'Future', actual: $this->data->getUrgency()->name);
        $this->assertEquals(expected: 'future', actual: $this->data->getUrgency()->value);
    }
}
