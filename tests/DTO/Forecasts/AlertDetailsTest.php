<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\DTO\Forecasts;

use DateTime;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\Area;
use Rugaard\WeatherKit\DTO\Coordinate;
use Rugaard\WeatherKit\DTO\Forecasts\AlertDetails;
use Rugaard\WeatherKit\DTO\Message;
use Rugaard\WeatherKit\DTO\Source;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Certainty;
use Rugaard\WeatherKit\Enums\Importance;
use Rugaard\WeatherKit\Enums\Severity;
use Rugaard\WeatherKit\Enums\Urgency;
use Rugaard\WeatherKit\Tests\AbstractTestCase;
use Rugaard\WeatherKit\Tests\Mocks\Responses as MockedResponses;

/**
 * AlertDetailsTest.
 *
 * @package Rugaard\WeatherKit\Tests\DTO\Forecasts
 */
class AlertDetailsTest extends AbstractTestCase
{
    use MockedResponses;

    /**
     * Alert data.
     *
     * @var \Rugaard\WeatherKit\DTO\Forecasts\AlertDetails
     */
    protected AlertDetails $data;

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
        $this->data = $this->client->setClient(client: $this->mockAlertRequest())->alert(alertId: 'mockedId');
    }

    /**
     * Test alert ID.
     *
     * @return void
     */
    public function testId(): void
    {
        $this->assertIsString(actual: $this->data->getId());
        $this->assertEquals(expected: 'cbff5515-5ed0-518b-ae8b-bcfdd5844d41', actual: $this->data->getId());
    }

    /**
     * Test area ID.
     *
     * @return void
     */
    public function testAreaId(): void
    {
        $this->assertIsString(actual: $this->data->getAreaId());
        $this->assertEquals(expected: 'caz017', actual: $this->data->getAreaId());
    }

    /**
     * Test area name.
     *
     * @return void
     */
    public function testAreaName(): void
    {
        $this->assertIsString(actual: $this->data->getAreaName());
        $this->assertEquals(expected: 'Southern Sacramento Valley', actual: $this->data->getAreaName());
    }

    /**
     * Test country code.
     *
     * @return void
     */
    public function testCountryCode(): void
    {
        $this->assertIsString(actual: $this->data->getCountryCOde());
        $this->assertEquals(expected: 'US', actual: $this->data->getCountryCode());
    }

    /**
     * Test description.
     *
     * @return void
     */
    public function testDescription(): void
    {
        $this->assertIsString(actual: $this->data->getDescription());
        $this->assertEquals(expected: 'Heat Advisory', actual: $this->data->getDescription());
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
        $this->assertEquals(expected: '2022-08-20T10:54:00.000+02:00', actual: $this->data->getAlertPeriod()->getStart()->format(format: DateTimeInterface::RFC3339_EXTENDED));
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getAlertPeriod()->getEnd());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getAlertPeriod()->getEnd()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-21T04:00:00.000+02:00', actual: $this->data->getAlertPeriod()->getEnd()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test event period.
     *
     * @return void
     */
    public function testEventPeriod(): void
    {
        $this->assertInstanceOf(expected: TimePeriod::class, actual: $this->data->getEventPeriod());
        $this->assertNull($this->data->getEventPeriod()->getStart());
        $this->assertInstanceOf(expected: DateTime::class, actual: $this->data->getEventPeriod()->getEnd());
        $this->assertEquals(expected: $this->timezone->getName(), actual: $this->data->getEventPeriod()->getEnd()->getTimezone()->getName());
        $this->assertEquals(expected: '2022-08-21T04:00:00.000+02:00', actual: $this->data->getEventPeriod()->getEnd()->format(format: DateTimeInterface::RFC3339_EXTENDED));
    }

    /**
     * Test embed URL.
     *
     * @return void
     */
    public function testEmbedUrl(): void
    {
        $this->assertIsString(actual: $this->data->getEmbedUrl());
        $this->assertEquals(expected: 'https://weatherkit.apple.com/alertDetails/index.html?ids=cbff5515-5ed0-518b-ae8b-bcfdd5844d41&lang=en-US&timezone=Europe/Copenhagen', actual: $this->data->getEmbedUrl());
    }

    /**
     * Test importance.
     *
     * @return void
     */
    public function testImportance(): void
    {
        $this->assertInstanceOf(expected: Importance::class, actual: $this->data->getImportance());
        $this->assertEquals(expected: 'Low', actual: $this->data->getImportance()->name);
        $this->assertEquals(expected: 'low', actual: $this->data->getImportance()->value);
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
        $this->assertEquals(expected: '2022-08-20T10:54:00.000+02:00', actual: $this->data->getIssuedTime()->format(format: DateTimeInterface::RFC3339_EXTENDED));
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
        $this->assertTrue(condition: $this->data->getRecommendedActions()->isEmpty());
    }

    /**
     * Test severity.
     *
     * @return void
     */
    public function testSeverity(): void
    {
        $this->assertInstanceOf(expected: Severity::class, actual: $this->data->getSeverity());
        $this->assertEquals(expected: 'Minor', actual: $this->data->getSeverity()->name);
        $this->assertEquals(expected: 'minor', actual: $this->data->getSeverity()->value);
    }

    /**
     * Test source.
     *
     * @return void
     */
    public function testSource(): void
    {
        $this->assertInstanceOf(expected: Source::class, actual: $this->data->getSource());
        $this->assertEquals(expected: 'National Weather Service', actual: $this->data->getSource()->getName());
        $this->assertEquals(expected: 'US', actual: $this->data->getSource()->getService());
    }

    /**
     * Test urgency.
     *
     * @return void
     */
    public function testUrgency(): void
    {
        $this->assertInstanceOf(expected: Urgency::class, actual: $this->data->getUrgency());
        $this->assertEquals(expected: 'Expected', actual: $this->data->getUrgency()->name);
        $this->assertEquals(expected: 'expected', actual: $this->data->getUrgency()->value);
    }

    /**
     * Test area.
     *
     * @return void
     */
    public function testArea(): void
    {
        $this->assertInstanceOf(expected: Area::class, actual: $this->data->getArea());
        $this->assertEquals(expected: 'Polygon', actual: $this->data->getArea()->getType());

        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getArea()->getCoordinates());
        $this->assertCount(expectedCount:177, haystack: $this->data->getArea()->getCoordinates());

        $coordinate = $this->data->getArea()->getCoordinates()->first();
        $this->assertInstanceOf(expected: Coordinate::class, actual: $coordinate);
        $this->assertIsFloat(actual: $coordinate->getLatitude());
        $this->assertEquals(expected: 38.8967, actual: $coordinate->getLatitude());
        $this->assertIsFloat(actual: $coordinate->getLongitude());
        $this->assertEquals(expected: -122.4156, actual: $coordinate->getLongitude());
        $this->assertEquals(expected: '38.8967,-122.4156', actual: (string) $coordinate);
    }

    /**
     * Test alert messages.
     *
     * @return void
     */
    public function testMessages(): void
    {
        $this->assertInstanceOf(expected: Collection::class, actual: $this->data->getMessages());
        $this->assertCount(expectedCount:1, haystack: $this->data->getMessages());

        $message = $this->data->getMessages()->first();
        $this->assertInstanceOf(expected: Message::class, actual: $message);
        $this->assertEquals(expected: 'en', actual: $message->getLanguage());
        $this->assertEquals(expected: "...HEAT ADVISORY REMAINS IN EFFECT UNTIL 7 PM PDT THIS EVENING...\n* WHAT...Highs 100 to 110.\n* WHERE...Sacramento Valley, northern San Joaquin Valley, the\nadjacent foothills, and the eastern Delta. Includes the cities\nof Redding, Chico, Sacramento, Grass Valley, Stockton and\nModesto.\n* WHEN...Until 7 PM PDT this evening.\n* IMPACTS...Widespread moderate to high heat risk expected. Hot\ntemperatures will significantly increase the potential for\nheat- related illnesses, particularly for those working or\nparticipating in outdoor activities.", actual: $message->getText());
    }
}
