<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Forecasts;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;

/**
 * Minute forecast.
 *
 * @package Rugaard\WeatherKit\DTO\Forecasts
 */
class Minute extends AbstractDTO
{
    /**
     * Timezone of data.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * Forecast time.
     *
     * @var \DateTime
     */
    protected DateTime $forecastTime;

    /**
     * Precipitation measurements.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $precipitation;

    /**
     * AbstractDTO constructor.
     *
     * @param array $data
     * @param \DateTimeZone $timezone
     */
    public function __construct(array $data, DateTimeZone $timezone)
    {
        $this->timezone = $timezone;
        parent::__construct($data);
    }

    /**
     * Parse data.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    protected function parse(array $data): void
    {
        $this->setForecastTime($data['startTime'])
             ->setPrecipitation($data['precipitationChance'], $data['precipitationIntensity']);
    }

    /**
     * Set forecast time.
     *
     * @param string $forecastTime
     * @return $this
     * @throws \Exception
     */
    public function setForecastTime(string $forecastTime): self
    {
        $this->forecastTime = (new DateTime(datetime: $forecastTime))->setTimezone(timezone: $this->timezone);
        return $this;
    }

    /**
     * Get forecast time.
     *
     * @return \DateTime
     */
    public function getForecastTime(): DateTime
    {
        return $this->forecastTime;
    }

    /**
     * Set precipitation measurements.
     *
     * @param int|float $chance
     * @param int|float $intensity
     * @return $this
     */
    public function setPrecipitation(int|float $chance, int|float $intensity): self
    {
        $this->precipitation = Collection::make([
            'chance' => (float) $chance * 100,
            'intensity' => new Precipitation(['value' => $intensity]),
        ]);
        return $this;
    }

    /**
     * Get precipitation measurements.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPrecipitation(): Collection
    {
        return $this->precipitation;
    }
}
