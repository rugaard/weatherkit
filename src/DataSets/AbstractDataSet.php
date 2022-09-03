<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DataSets;

use DateTime;
use DateTimeZone;
use Rugaard\WeatherKit\DTO\Coordinate;
use Rugaard\WeatherKit\DTO\Provider;

use function array_filter;
use function in_array;
use function method_exists;
use function str_replace;
use function str_split;
use function ucwords;

use const ARRAY_FILTER_USE_KEY;

/**
 * AbstractDataSet.
 *
 * @abstract
 * @package Rugaard\WeatherKit\DataSet
 */
abstract class AbstractDataSet
{
    /**
     * The relevant location of the weather data.
     *
     * @var \Rugaard\WeatherKit\DTO\Coordinate
     */
    protected Coordinate $location;

    /**
     * Provider of weather data.
     *
     * @var \Rugaard\WeatherKit\DTO\Provider|null
     */
    protected ?Provider $provider;

    /**
     * The URL to the legal attribution of the data source.
     *
     * @var string|null
     */
    protected ?string $legalUrl;

    /**
     * The time when the weather data is no longer valid.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $expireTime;

    /**
     * The time the weather data was procured.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $readTime;

    /**
     * The time the provider reported the weather data.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $reportedTime;

    /**
     * Timezone of data.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * The data format version.
     *
     * @var int
     */
    protected int $version;

    /**
     * AbstractDataSet constructor.
     *
     * @param array $data
     * @param \DateTimeZone $timezone
     */
    public function __construct(array $data, DateTimeZone $timezone)
    {
        $this->timezone = $timezone;
        $this->parse(array_filter(array: $data, callback: static fn($key) => !in_array($key, ['name', 'metadata']), mode: ARRAY_FILTER_USE_KEY) ?? []);
        $this->metadata(data: $data['metadata'] ?? []);
    }

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     */
    abstract protected function parse(array $data): void;

    /**
     * Parse metadata.
     *
     * @param array $data
     * @return void
     */
    protected function metadata(array $data): void
    {
        // Merge latitude/longitude into a location.
        if (!empty($data['latitude']) && !empty($data['longitude'])) {
            $this->setLocation($data['latitude'], $data['longitude']);
        }

        // Merge data provider details.
        if (!empty($data['providerName']) || !empty($data['providerLogo'])) {
            $this->setProvider(name: $data['providerName'] ?? null, logoUrl: $data['providerLogo'] ?? null, unavailable: $data['temporarilyUnavailable'] ?? false);
        }

        // Set legal attribution URL.
        if (!empty($data['attributionURL'])) {
            $this->setLegalUrl(url: $data['attributionURL']);
        }

        // Loop through available metadata
        // and parse each supported property.
        foreach ($data as $key => $value) {
            // Determine property name by key.
            $propertyName = lcfirst(string: str_replace(search: str_split(' -'), replace: '', subject: ucwords($key, ' -')));

            // Validate property name
            // and that a setter method exists.
            if (!method_exists(object_or_class: $this, method: 'set' . $propertyName)) {
                continue;
            }

            // Set property with value.
            $this->{'set' . $propertyName}($value);
        }
    }

    /**
     * Set location of weather data.
     *
     * @param float $latitude
     * @param float $longitude
     * @return $this
     */
    public function setLocation(float $latitude, float $longitude): self
    {
        $this->location = new Coordinate(['latitude' => $latitude, 'longitude' => $longitude]);
        return $this;
    }

    /**
     * Get location of weather data.
     *
     * @return \Rugaard\WeatherKit\DTO\Coordinate
     */
    public function getLocation(): Coordinate
    {
        return $this->location;
    }

    /**
     * Set provider of weather data.
     *
     * @param string|null $name
     * @param string|null $logoUrl
     * @param bool $unavailable
     * @return $this
     */
    public function setProvider(?string $name, ?string $logoUrl, bool $unavailable = false): self
    {
        $this->provider = new Provider(['name' => $name, 'logoUrl' => $logoUrl, 'unavailable' => $unavailable]);
        return $this;
    }

    /**
     * Get provider of weather data.
     *
     * @return \Rugaard\WeatherKit\DTO\Provider|null
     */
    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    /**
     * Set URL to legal attribution of data source.
     *
     * @param string|null $url
     * @return $this
     */
    public function setLegalUrl(?string $url): self
    {
        $this->legalUrl = $url;
        return $this;
    }

    /**
     * Get URL to legal attribution of data source.
     *
     * @return string|null
     */
    public function getLegalUrl(): ?string
    {
        return $this->legalUrl;
    }

    /**
     * Set the time when the weather data is no longer valid.
     *
     * @param string $expireTime
     * @return $this
     * @throws \Exception
     */
    public function setExpireTime(string $expireTime): self
    {
        $this->expireTime = (new DateTime(datetime: $expireTime))->setTimezone(timezone: $this->timezone);
        return $this;
    }

    /**
     * Get the time when the weather data is no longer valid.
     *
     * @return \DateTime
     */
    public function getExpireTime(): DateTime
    {
        return $this->expireTime;
    }

    /**
     * Set the time the weather data was procured.
     *
     * @param string $readTime
     * @return $this
     * @throws \Exception
     */
    public function setReadTime(string $readTime): self
    {
        $this->readTime = (new DateTime(datetime: $readTime))->setTimezone(timezone: $this->timezone);
        return $this;
    }

    /**
     * Get the time the weather data was procured.
     *
     * @return \DateTime
     */
    public function getReadTime(): DateTime
    {
        return $this->readTime;
    }

    /**
     * Set the time the provider reported the weather data.
     *
     * @param string $reportedTime
     * @return $this
     * @throws \Exception
     */
    public function setReportedTime(string $reportedTime): self
    {
        $this->reportedTime = (new DateTime(datetime: $reportedTime))->setTimezone(timezone: $this->timezone);
        return $this;
    }

    /**
     * Get the time the provider reported the weather data.
     *
     * @return \DateTime
     */
    public function getReportedTime(): DateTime
    {
        return $this->reportedTime;
    }

    /**
     * Set the data format version.
     *
     * @param int $version
     * @return $this
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Get the data format version.
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Return DTO as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        // Get all properties in class.
        $properties = get_object_vars(object: $this);

        // Container
        $container = [];

        // Loop through each value and look for the getter method.
        // If it doesn't exist, we'll ignore the variable.
        foreach (array_filter($properties, static fn($key) => $key !== 'propertyMapping', ARRAY_FILTER_USE_KEY) as $propertyName => $propertyValue) {
            // Generate getter method name.
            $propertyMethod = 'get' . ucfirst(string: $propertyName);

            // Validate that getter method exists.
            if (!method_exists(object_or_class: $this, method: $propertyMethod)) {
                continue;
            }

            // Get value of variable.
            $value = $this->$propertyMethod();

            // Add value to container.
            $container[$propertyName] = ($value instanceof self) ? $value->toArray() : $value;
        }

        return $container;
    }
}
