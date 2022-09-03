<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

use DateTime;
use DateTimeZone;

/**
 * TimePeriod.
 *
 * @package Rugaard\WeatherKit\DTO
 */
class TimePeriod extends AbstractDTO
{
    /**
     * Timezone of data.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * Start of period.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $start;

    /**
     * End of period.
     *
     * @var \DateTime|null
     */
    protected ?DateTime $end;

    /**
     * TimePeriod constructor.
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
        $this->setStart(start: $data['start'])
             ->setEnd(end: $data['end']);
    }

    /**
     * Set start timestamp.
     *
     * @param string|null $start
     * @return $this
     * @throws \Exception
     */
    public function setStart(?string $start): self
    {
        $this->start = $start !== null ? (new DateTime(datetime: $start))->setTimezone(timezone: $this->timezone) : null;
        return $this;
    }

    /**
     * Get start timestamp.
     *
     * @return \DateTime|null
     */
    public function getStart(): ?DateTime
    {
        return $this->start;
    }

    /**
     * Set end timestamp.
     *
     * @param string|null $end
     * @return $this
     * @throws \Exception
     */
    public function setEnd(?string $end): self
    {
        $this->end = $end !== null ? (new DateTime(datetime: $end))->setTimezone(timezone: $this->timezone) : null;
        return $this;
    }

    /**
     * Get end timestamp.
     *
     * @return \DateTime|null
     */
    public function getEnd(): ?DateTime
    {
        return $this->end;
    }
}
