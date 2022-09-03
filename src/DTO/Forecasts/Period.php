<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Forecasts;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\DTO\Measurements\CloudCover;
use Rugaard\WeatherKit\DTO\Measurements\Direction;
use Rugaard\WeatherKit\DTO\Measurements\Humidity;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\Measurements\Wind;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Precipitation as PrecipitationType;
use Rugaard\WeatherKit\Enums\WeatherCondition;

/**
 * Period.
 *
 * @package Rugaard\WeatherKit\DTO\Forecasts
 */
class Period extends AbstractDTO
{
    /**
     * Timezone of data.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * Cloud cover measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\CloudCover
     */
    protected CloudCover $cloudCover;

    /**
     * Weather condition.
     *
     * @var \Rugaard\WeatherKit\Enums\WeatherCondition
     */
    protected WeatherCondition $condition;

    /**
     * Forecast time.
     *
     * @var \Rugaard\WeatherKit\DTO\TimePeriod
     */
    protected TimePeriod $forecastTime;

    /**
     * Humidity measurement.
     *
     * @var \Rugaard\WeatherKit\DTO\Measurements\Humidity
     */
    protected Humidity $humidity;

    /**
     * Precipitation measurements.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $precipitation;

    /**
     * Wind measurements.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $wind;

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
     * Parse data set.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    protected function parse(array $data): void
    {
        $this->setCloudCover($data['cloudCover'])
             ->setCondition($data['conditionCode'])
             ->setForecastTime($data['forecastStart'], $data['forecastEnd'])
             ->setHumidity($data['humidity'])
             ->setPrecipitation($data['precipitationType'], $data['precipitationChance'], $data['precipitationAmount'], $data['snowfallAmount'])
             ->setWind($data['windSpeed'], $data['windDirection'] ?? null);
    }

    /**
     * Set cloud cover measurement.
     *
     * @param int|float|null $cloudCover
     * @return $this
     */
    public function setCloudCover(int|float|null $cloudCover): self
    {
        $this->cloudCover = $cloudCover !== null ? new CloudCover(['value' => $cloudCover]) : null;
        return $this;
    }

    /**
     * Get cloud cover measurement.
     *
     * @return \Rugaard\WeatherKit\DTO\Measurements\CloudCover|null
     */
    public function getCloudCover(): ?CloudCover
    {
        return $this->cloudCover;
    }

    /**
     * Set weather condition.
     *
     * @param string $condition
     * @return $this
     */
    public function setCondition(string $condition): self
    {
        $this->condition = WeatherCondition::tryFromName($condition);
        return $this;
    }

    /**
     * Get weather condition.
     *
     * @return \Rugaard\WeatherKit\Enums\WeatherCondition|null
     */
    public function getCondition(): ?WeatherCondition
    {
        return $this->condition;
    }

    /**
     * Set forecast time.
     *
     * @param string $startTime
     * @param string $endTime
     * @return $this
     * @throws \Exception
     */
    public function setForecastTime(string $startTime, string $endTime): self
    {
        $this->forecastTime = new TimePeriod(['start' => $startTime, 'end' => $endTime], $this->timezone);
        return $this;
    }

    /**
     * Get forecast time.
     *
     * @return \Rugaard\WeatherKit\DTO\TimePeriod
     */
    public function getForecastTime(): TimePeriod
    {
        return $this->forecastTime;
    }

    /**
     * Set humidity measurement.
     *
     * @param int|float $humidity
     * @return $this
     */
    public function setHumidity(int|float $humidity): self
    {
        $this->humidity = new Humidity(['value' => $humidity]);
        return $this;
    }

    /**
     * Get humidity measurement.
     *
     * @return \Rugaard\WeatherKit\DTO\Measurements\Humidity
     */
    public function getHumidity(): Humidity
    {
        return $this->humidity;
    }

    /**
     * Set precipitation measurements.
     *
     * @param string $type
     * @param int|float $chance
     * @param int|float $amount
     * @param int|float $snowfall
     * @return $this
     */
    public function setPrecipitation(string $type, int|float $chance, int|float $amount, int|float $snowfall): self
    {
        $this->precipitation = Collection::make([
            'type' => PrecipitationType::tryFrom($type),
            'chance' => (float) $chance * 100,
            'amount' => new Precipitation(['value' => $amount]),
            'snowfall' => new Precipitation(['value' => $snowfall]),
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

    /**
     * Set wind measurement.
     *
     * @param int|float $speed
     * @param int|null $direction
     * @return $this
     */
    public function setWind(int|float $speed, ?int $direction): self
    {
        $this->wind = Collection::make([
            'speed' => new Wind(['value' => $speed]),
            'direction' => $direction !== null ? new Direction(['value' => $direction]) : null
        ]);
        return $this;
    }

    /**
     * Get wind measurement.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getWind(): Collection
    {
        return $this->wind;
    }
}
