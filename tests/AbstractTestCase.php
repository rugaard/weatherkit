<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests;

use DateTimeZone;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler as GuzzleMockHandler;
use GuzzleHttp\HandlerStack as GuzzleHandlerStack;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Rugaard\WeatherKit\Client;

/**
 * Class AbstractTestCase.
 *
 * @package Rugaard\DMI\Tests
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Client timezone.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * WeatherKit Client.
     *
     * @var \Rugaard\WeatherKit\Client
     */
    protected Client $client;

    /**
     * Set up test case.
     *
     * @return void
     * @throws \Rugaard\WeatherKit\Exceptions\InvalidTimezoneException
     */
    protected function setUp(): void
    {
        $this->timezone = $timezone = new DateTimeZone(timezone: 'Europe/Copenhagen');
        $this->client = new Client(token: 'MockedToken', latitude: 0.0, longitude: 0.0, countryCode: 'mockedCountryCode', languageCode: 'mockedLanguageCode', timezone: $timezone->getName());
    }

    /**
     * Create a Guzzle Client with mocked responses.
     *
     * @param  array $responses
     * @return \GuzzleHttp\Client
     */
    protected function createMockedGuzzleClient(array $responses): GuzzleClient
    {
        return new GuzzleClient(config: [
            'handler' => GuzzleHandlerStack::create(
                handler: new GuzzleMockHandler($responses)
            ),
        ]);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param  mixed &$object
     * @param  string $methodName
     * @param  array  $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeMethod(mixed &$object, string $methodName, array $parameters = []): mixed
    {
        $reflection = new ReflectionClass(objectOrClass: get_class($object));
        $method = $reflection->getMethod(name: $methodName);
        $method->setAccessible(accessible: true);
        return $method->invokeArgs(object: $object, args: $parameters);
    }
}
