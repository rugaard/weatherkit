<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

use DateTime;
use DateTimeZone;

/**
 * SunTimes.
 *
 * @package Rugaard\WeatherKit\DTO
 */
class SunTimes extends AbstractDTO
{
    /**
     * Timezone of data.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * Sun time value.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $time;

    /**
     * Civil timestamp.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $civil;

    /**
     * Nautical timestamp.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $nautical;

    /**
     * Astronomical timestamp.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $astronomical;

    /**
     * SunTimes constructor.
     *
     * @param array $data
     * @param \DateTimeZone $timezone
     */
    public function __construct(array $data, DateTimeZone $timezone)
    {
        $this->timezone = $timezone;
        parent::__construct(data: $data);
    }

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function parse(array $data): void
    {
        $this->setTime(time: $data['value'] ?? null)
             ->setCivil(civil: $data['civil'] ?? null)
             ->setNautical(nautical: $data['nautical'] ?? null)
             ->setAstronomical(astronomical: $data['astronomical'] ?? null);
    }

    /**
     * Set sunrise timestamp.
     *
     * @param string|null $time
     * @return $this
     * @throws \Exception
     */
    public function setTime(?string $time): self
    {
        $this->time = $time !== null ? (new DateTime(datetime: $time))->setTimezone(timezone: $this->timezone) : null;
        return $this;
    }

    /**
     * Get sunrise timestamp.
     *
     * @return \DateTime|null
     */
    public function getTime(): ?DateTime
    {
        return $this->time;
    }

    /**
     * Set sunrise civil timestamp.
     *
     * @param string|null $civil
     * @return $this
     * @throws \Exception
     */
    public function setCivil(?string $civil): self
    {
        $this->civil = $civil !== null ? (new DateTime(datetime: $civil))->setTimezone(timezone: $this->timezone) : null;
        return $this;
    }

    /**
     * Get sunrise civil timestamp.
     *
     * @return \DateTime|null
     */
    public function getCivil(): ?DateTime
    {
        return $this->civil;
    }

    /**
     * Set sunrise nautical timestamp.
     *
     * @param string|null $nautical
     * @return $this
     * @throws \Exception
     */
    public function setNautical(?string $nautical): self
    {
        $this->nautical = $nautical !== null ? (new DateTime(datetime: $nautical))->setTimezone(timezone: $this->timezone) : null;
        return $this;
    }

    /**
     * Get sunrise nautical timestamp.
     *
     * @return \DateTime|null
     */
    public function getNautical(): ?DateTime
    {
        return $this->nautical;
    }

    /**
     * Set sunrise astronomical timestamp.
     *
     * @param string|null $astronomical
     * @return $this
     * @throws \Exception
     */
    public function setAstronomical(?string $astronomical): self
    {
        $this->astronomical = $astronomical !== null ? (new DateTime(datetime: $astronomical))->setTimezone(timezone: $this->timezone) : null;
        return $this;
    }

    /**
     * Get sunrise astronomical timestamp.
     *
     * @return \DateTime|null
     */
    public function getAstronomical(): ?DateTime
    {
        return $this->astronomical;
    }
}
