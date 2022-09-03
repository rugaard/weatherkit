<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

use DateTime;
use DateTimeZone;
use Rugaard\WeatherKit\Enums\Moon as MoonPhase;

/**
 * Moon.
 *
 * @package Rugaard\WeatherKit\DTO
 */
class Moon extends AbstractDTO
{
    /**
     * Timezone of data.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * Moonrise timestamp.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $moonrise;

    /**
     * Moonset timestamp.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $moonset;

    /**
     * Moon phase.
     *
     * @var \Rugaard\WeatherKit\Enums\Moon|null
     */
    protected ?MoonPhase $phase;

    /**
     * Moon constructor.
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
        $this->setMoonrise(moonrise: $data['moonrise'])
             ->setMoonset(moonset: $data['moonset'])
             ->setPhase(phase: $data['phase'] ?? null);
    }

    /**
     * Set moonrise timestamp.
     *
     * @param string|null $moonrise
     * @return $this
     * @throws \Exception
     */
    public function setMoonrise(?string $moonrise): self
    {
        $this->moonrise = $moonrise !== null ? (new DateTime(datetime: $moonrise))->setTimezone(timezone: $this->timezone) : null;
        return $this;
    }

    /**
     * Get moonrise timestamp.
     *
     * @return \DateTime
     */
    public function getMoonrise(): DateTime
    {
        return $this->moonrise;
    }

    /**
     * Set moonset timestamp.
     *
     * @param string|null $moonset
     * @return $this
     * @throws \Exception
     */
    public function setMoonset(?string $moonset): self
    {
        $this->moonset = $moonset !== null ? (new DateTime(datetime: $moonset))->setTimezone(timezone: $this->timezone) : null;
        return $this;
    }

    /**
     * Get moonset timestamp.
     *
     * @return \DateTime
     */
    public function getMoonset(): DateTime
    {
        return $this->moonset;
    }

    /**
     * Set moon phase.
     *
     * @param string|null $phase
     * @return $this
     */
    public function setPhase(?string $phase): self
    {
        $this->phase = $phase !== null ? MoonPhase::tryFrom(value: $phase) : null;
        return $this;
    }

    /**
     * Get moon phase.
     *
     * @return \Rugaard\WeatherKit\Enums\Moon|null
     */
    public function getPhase(): ?MoonPhase
    {
        return $this->phase;
    }
}
