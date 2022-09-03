<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DataSets;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\Client;
use Rugaard\WeatherKit\DataSets\Alerts;
use Rugaard\WeatherKit\DTO\Coordinate;
use Rugaard\WeatherKit\DTO\Forecasts\Alert;
use Rugaard\WeatherKit\DTO\Source;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Action;
use Rugaard\WeatherKit\Enums\Certainty;
use Rugaard\WeatherKit\Enums\Importance;
use Rugaard\WeatherKit\Enums\Severity;
use Rugaard\WeatherKit\Enums\Urgency;
use Rugaard\WeatherKit\Exceptions\MissingCoordinateException;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;

/**
 * AlertsTest.
 *
 * @package Rugaard\WeatherKit\Tests\DataSets
 */
class AlertsTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Alerts dataset.
     *
     * @var \Rugaard\WeatherKit\DataSets\Alerts
     */
    protected Alerts $data;

    /**
     * Alert data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\Alert
     */
    protected Alert $alert;

    /**
     * Set up test case.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $data = $this->client->setClient(client: $this->mockForecastRequest())->alerts();
        $this->alert = $data->getData()->first();
    }

    /**
     * Test alerts request without a location.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\JsonDecodeFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\MissingCoordinateException
     */
    public function testAvailabilityWithoutLocation(): void
    {
        $this->expectException(MissingCoordinateException::class);
        (new Client(token: 'MockedToken'))->alerts();
    }

    /**
     * Test data instance.
     *
     * @return void
     */
    public function testDataInstance(): void
    {
        $this->assertInstanceOf(expected: Alerts::class, actual: $this->data);
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getData());
        $this->assertCount(expectedCount: 1, haystack: $this->data->getData());
    }

    /**
     * Test location.
     *
     * @return void
     */
    public function testLocation(): void
    {
        $this->assertInstanceOf(expected: Coordinate::class, actual: $this->data->getLocation());
        $this->assertIsFloat(actual: $this->data->getLocation()->getLatitude());
        $this->assertEquals(expected: 51.529, actual: $this->data->getLocation()->getLatitude());
        $this->assertIsFloat(actual: $this->data->getLocation()->getLongitude());
        $this->assertEquals(expected: -0.102, actual: $this->data->getLocation()->getLongitude());

        $coordinate = (string) $this->data->getLocation();
        $this->assertIsString(actual: $coordinate);
        $this->assertEquals(expected: '51.529,-0.102', actual: $coordinate);
    }

    /**
     * Test expire time.
     *
     * @return void
     */
    public function testExpireTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getExpireTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getExpireTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T20:04:01.000+02:00', actual: $this->data->getExpireTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test read time.
     *
     * @return void
     */
    public function testReadTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getReadTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getReadTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T19:59:01.000+02:00', actual: $this->data->getReadTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test reported time.
     *
     * @return void
     */
    public function testReportedTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getReportedTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getReportedTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T19:59:01.000+02:00', actual: $this->data->getReportedTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test version
     *
     * @return void
     */
    public function testVersion(): void
    {
        $this->assertIsInt(actual: $this->data->getVersion());
        $this->assertEquals(expected: 1, actual: $this->data->getVersion());
    }

    /**
     * Test alert ID.
     *
     * @return void
     */
    public function testId(): void
    {
        $this->assertIsString(actual: $this->alert->getId());
        $this->assertEquals(expected: 'd26dc1fb-da0c-52a5-9c4e-c1462ffc5f38', actual: $this->alert->getId());
    }

    /**
     * Test area ID.
     *
     * @return void
     */
    public function testAreaId(): void
    {
        $this->assertIsString(actual: $this->alert->getAreaId());
        $this->assertEquals(expected: 'UK116', actual: $this->alert->getAreaId());
    }

    /**
     * Test area name.
     *
     * @return void
     */
    public function testAreaName(): void
    {
        $this->assertIsString(actual: $this->alert->getAreaName());
        $this->assertEquals(expected: 'London & South East England', actual: $this->alert->getAreaName());
    }

    /**
     * Test country code.
     *
     * @return void
     */
    public function testCountryCode(): void
    {
        $this->assertIsString(actual: $this->alert->getCountryCOde());
        $this->assertEquals(expected: 'GB', actual: $this->alert->getCountryCode());
    }

    /**
     * Test description.
     *
     * @return void
     */
    public function testDescription(): void
    {
        $this->assertIsString(actual: $this->alert->getDescription());
        $this->assertEquals(expected: 'Moderate Thunderstorm Warning', actual: $this->alert->getDescription());
    }

    /**
     * Test certainty.
     *
     * @return void
     */
    public function testCertainty(): void
    {
        $this->assertInstanceOf(expected: Certainty::class, actual: $this->alert->getCertainty());
        $this->assertEquals(expected: 'Likely', actual: $this->alert->getCertainty()->name);
        $this->assertEquals(expected: 'likely', actual: $this->alert->getCertainty()->value);
    }

    /**
     * Test alert period.
     *
     * @return void
     */
    public function testAlertPeriod(): void
    {
        $this->assertInstanceOf(expected: TimePeriod::class, actual: $this->alert->getAlertPeriod());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->alert->getAlertPeriod()->getStart());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->alert->getAlertPeriod()->getStart()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T18:04:17.000+02:00', actual: $this->alert->getAlertPeriod()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->alert->getAlertPeriod()->getEnd());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->alert->getAlertPeriod()->getEnd()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-25T16:00:00.000+02:00', actual: $this->alert->getAlertPeriod()->getEnd()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test event period.
     *
     * @return void
     */
    public function testEventPeriod(): void
    {
        $this->assertInstanceOf(expected: TimePeriod::class, actual: $this->alert->getEventPeriod());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->alert->getEventPeriod()->getStart());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->alert->getEventPeriod()->getStart()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-25T01:00:00.000+02:00', actual: $this->alert->getEventPeriod()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertNull(actual: $this->alert->getEventPeriod()->getEnd());
    }

    /**
     * Test embed URL.
     *
     * @return void
     */
    public function testEmbedUrl(): void
    {
        $this->assertIsString(actual: $this->alert->getEmbedUrl());
        $this->assertEquals(expected: 'https://weatherkit.apple.com/alertDetails/index.html?ids=d26dc1fb-da0c-52a5-9c4e-c1462ffc5f38&lang=en-US&timezone=Europe/Copenhagen', actual: $this->alert->getEmbedUrl());
    }

    /**
     * Test importance.
     *
     * @return void
     */
    public function testImportance(): void
    {
        $this->assertInstanceOf(expected: Importance::class, actual: $this->alert->getImportance());
        $this->assertEquals(expected: 'Normal', actual: $this->alert->getImportance()->name);
        $this->assertEquals(expected: 'normal', actual: $this->alert->getImportance()->value);
    }

    /**
     * Test issue time.
     *
     * @return void
     */
    public function testIssueTime(): void
    {
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->alert->getIssuedTime());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->alert->getIssuedTime()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-24T18:04:17.000+02:00', actual: $this->alert->getIssuedTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test precedence.
     *
     * @return void
     */
    public function testPrecedence(): void
    {
        $this->assertIsBool(actual: $this->alert->getPrecedence());
        $this->assertFalse(condition: $this->alert->getPrecedence());
    }

    /**
     * Test recommended actions.
     *
     * @return void
     */
    public function testRecommendedActions(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->alert->getRecommendedActions());
        $this->assertTrue(condition: $this->alert->getRecommendedActions()->isNotEmpty());

        $action = $this->alert->getRecommendedActions()->first();
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
        $this->assertInstanceOf(expected: Severity::class, actual: $this->alert->getSeverity());
        $this->assertEquals(expected: 'Moderate', actual: $this->alert->getSeverity()->name);
        $this->assertEquals(expected: 'moderate', actual: $this->alert->getSeverity()->value);
    }

    /**
     * Test source.
     *
     * @return void
     */
    public function testSource(): void
    {
        $this->assertInstanceOf(expected: Source::class, actual: $this->alert->getSource());
        $this->assertEquals(expected: 'UK Met Office', actual: $this->alert->getSource()->getName());
        $this->assertEquals(expected: 'EUMETNET', actual: $this->alert->getSource()->getService());
    }

    /**
     * Test urgency.
     *
     * @return void
     */
    public function testUrgency(): void
    {
        $this->assertInstanceOf(expected: Urgency::class, actual: $this->alert->getUrgency());
        $this->assertEquals(expected: 'Future', actual: $this->alert->getUrgency()->name);
        $this->assertEquals(expected: 'future', actual: $this->alert->getUrgency()->value);
    }
}
