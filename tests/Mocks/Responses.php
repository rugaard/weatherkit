<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Tests\Mocks;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

use function file_get_contents;

/**
 * Trait Responses.
 *
 * @package Rugaard\WeatherKit\Tests\Mocks
 */
trait Responses
{
    /**
     * Mock Alert request.
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockAlertRequest(): GuzzleClient
    {
        return $this->createMockedGuzzleClient(responses: [
            new GuzzleResponse(status: 200, headers: [], body: file_get_contents(__DIR__ . '/JSON/Alert.json')),
        ]);
    }

    /**
     * Mock Availability request.
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockAvailabilityRequest(): GuzzleClient
    {
        return $this->createMockedGuzzleClient(responses: [
            new GuzzleResponse(status: 200, headers: [], body: file_get_contents(__DIR__ . '/JSON/Availability.json')),
        ]);
    }

    /**
     * Mock Forecast request.
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockForecastRequest(): GuzzleClient
    {
        return $this->createMockedGuzzleClient(responses: [
            new GuzzleResponse(status: 200, headers: [], body: file_get_contents(__DIR__ . '/JSON/Forecast.json')),
        ]);
    }

    /**
     * Mock Forecast request.
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockForecastUnsupportedDataSetRequest(): GuzzleClient
    {
        return $this->createMockedGuzzleClient(responses: [
            new GuzzleResponse(status: 200, headers: [], body: file_get_contents(__DIR__ . '/JSON/ForecastUnsupportedDataSet.json')),
        ]);
    }

    /**
     * Mock invalid JSON response.
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockInvalidJsonRequest(): GuzzleClient
    {
        return $this->createMockedGuzzleClient(responses: [
            new GuzzleResponse(status: 200, headers: [], body: 'This is not JSON.'),
        ]);
    }

    /**
     * Mock "204 No Content" request.
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockNoContentRequest(): GuzzleClient
    {
        return $this->createMockedGuzzleClient(responses: [
            new GuzzleResponse(status: 204, headers: [], body: null),
        ]);
    }

    /**
     * Mock "404 Not Found" request.
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockNotFoundRequest(): GuzzleClient
    {
        return $this->createMockedGuzzleClient(responses: [
            new GuzzleResponse(status: 404, headers: [], body: null),
        ]);
    }

    /**
     * Mock "500 Internal Server Error" request.
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockInternalErrorRequest(): GuzzleClient
    {
        return $this->createMockedGuzzleClient(responses: [
            new GuzzleResponse(status: 500, headers: [], body: null),
        ]);
    }
}
