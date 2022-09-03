<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO\Forecasts;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Collection;
use Rugaard\WeatherKit\DTO\AbstractDTO;
use Rugaard\WeatherKit\DTO\Measurements\Precipitation;
use Rugaard\WeatherKit\DTO\Measurements\Temperature;
use Rugaard\WeatherKit\DTO\Moon;
use Rugaard\WeatherKit\DTO\SunTimes;
use Rugaard\WeatherKit\DTO\TimePeriod;
use Rugaard\WeatherKit\Enums\Precipitation as PrecipitationType;
use Rugaard\WeatherKit\Enums\UVIndex;
use Rugaard\WeatherKit\Enums\WeatherCondition;

use const ARRAY_FILTER_USE_KEY;

/**
 * Day forecast.
 *
 * @package Rugaard\WeatherKit\DTO\Forecasts
 */
class Day extends AbstractDTO
{
    /**
     * Timezone of data.
     *
     * @var \DateTimeZone
     */
    protected DateTimeZone $timezone;

    /**
     * Weather condition.
     *
     * @var \Rugaard\WeatherKit\Enums\WeatherCondition|null
     */
    protected ?WeatherCondition $condition;

    /**
     * Collection of forecasts.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $forecasts;

    /**
     * Forecast period.
     *
     * @var \Rugaard\WeatherKit\DTO\TimePeriod
     */
    protected TimePeriod $forecastTime;

    /**
     * Max UV Index measurement.
     *
     * @var \Rugaard\WeatherKit\Enums\UVIndex
     */
    protected UVIndex $maxUVIndex;

    /**
     * Moon details.
     *
     * @var \Rugaard\WeatherKit\DTO\Moon
     */
    protected Moon $moon;

    /**
     * Precipitation measurements.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $precipitation;

    /**
     * Sun time details.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $sunTimes;

    /**
     * Temperature measurements.
     *
     * @var \Illuminate\Support\Collection
     */
    protected Collection $temperature;

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
        $this->setCondition($data['conditionCode'])
             ->setForecasts($data['daytimeForecast'] ?? null, $data['overnightForecast'] ?? null, $data['restOfDayForecast'] ?? null)
             ->setForecastTime($data['forecastStart'], $data['forecastEnd'])
             ->setMoon($data['moonrise'] ?? null, $data['moonset'] ?? null, $data['moonPhase'])
             ->setMaxUVIndex($data['maxUvIndex'])
             ->setPrecipitation($data['precipitationType'], $data['precipitationChance'], $data['precipitationAmount'], $data['snowfallAmount'])
             ->setSunTimes(array_filter($data, static function (string $key) {
                return in_array($key, [
                    'solarMidnight', 'solarNoon',
                    'sunrise', 'sunriseAstronomical', 'sunriseCivil', 'sunriseNautical',
                    'sunset', 'sunsetAstronomical', 'sunsetCivil', 'sunsetNautical'
                ]);
             }, ARRAY_FILTER_USE_KEY))
             ->setTemperature($data['temperatureMin'], $data['temperatureMax']);
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
     * Set collection of forecasts.
     *
     * @param array|null $daytime
     * @param array|null $overnight
     * @param array|null $restOfDay
     * @return $this
     */
    public function setForecasts(?array $daytime, ?array $overnight, ?array $restOfDay): self
    {
        $this->forecasts = Collection::make([
            'daytime' => $daytime !== null ? new Period($daytime, $this->timezone) : null,
            'overnight' => $daytime !== null ? new Period($overnight, $this->timezone) : null,
        ]);

        if ($restOfDay !== null) {
            $this->forecasts->put('restOfDay', new Period($restOfDay, $this->timezone));
        }

        return $this;
    }

    /**
     * Get collection of forecasts.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getForecasts(): Collection
    {
        return $this->forecasts;
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
     * Get forecast period.
     *
     * @return \Rugaard\WeatherKit\DTO\TimePeriod
     */
    public function getForecastTime(): TimePeriod
    {
        return $this->forecastTime;
    }

    /**
     * Set UV index.
     *
     * @param int $uvIndex
     * @return $this
     */
    public function setMaxUVIndex(int $uvIndex): self
    {
        $this->maxUVIndex = UVIndex::from($uvIndex);
        return $this;
    }

    /**
     * Get UV index.
     *
     * @return \Rugaard\WeatherKit\Enums\UVIndex
     */
    public function getMaxUVIndex(): UVIndex
    {
        return $this->maxUVIndex;
    }

    /**
     * Set moon details.
     *
     * @param string|null $moonrise
     * @param string|null $moonset
     * @param string|null $phase
     * @return $this
     */
    public function setMoon(?string $moonrise, ?string $moonset, ?string $phase): self
    {
        $this->moon = new Moon(['moonrise' => $moonrise, 'moonset' => $moonset, 'phase' => $phase], $this->timezone);
        return $this;
    }

    /**
     * Get moon details.
     *
     * @return \Rugaard\WeatherKit\DTO\Moon
     */
    public function getMoon(): Moon
    {
        return $this->moon;
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
            'snowfall' => new Precipitation(['value' => $snowfall])
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
     * Set sun details.
     *
     * @param array $data
     * @return $this
     * @throws \Exception
     */
    public function setSunTimes(array $data): self
    {
        /*
        $sunTimes = Collection::make();
        foreach ($data as $key => $value) {
            match ($key) {
                'sunrise', 'sunset' => $sunTimes->put($key, Collection::make(['time' => (new DateTime($value))->setTimezone($this->timezone)])),
                'sunriseAstronomical', 'sunriseCivil', 'sunriseNautical' => $sunTimes->put('sunrise', $sunTimes->get('sunrise')->put(lcfirst(str_replace('sunrise', '', $key)), (new DateTime($value))->setTimezone($this->timezone))),
                'sunsetAstronomical', 'sunsetCivil', 'sunsetNautical' => $sunTimes->put('sunset', $sunTimes->get('sunset')->put(lcfirst(str_replace('sunset', '', $key)), (new DateTime($value))->setTimezone($this->timezone))),
                default => $sunTimes->put($key, )
            };
        }
        */
        $this->sunTimes = Collection::make([
            'solarMidnight' => (new DateTime($data['solarMidnight']))->setTimezone($this->timezone),
            'solarNoon' => (new DateTime($data['solarNoon']))->setTimezone($this->timezone),
            'sunrise' => new SunTimes([
                'value' => $data['sunrise'],
                'civil' => $data['sunriseCivil'],
                'nautical' => $data['sunriseNautical'],
                'astronomical' => $data['sunriseAstronomical'],
            ], $this->timezone),
            'sunset' => new SunTimes([
                'value' => $data['sunset'],
                'civil' => $data['sunsetCivil'],
                'nautical' => $data['sunsetNautical'],
                'astronomical' => $data['sunsetAstronomical'],
            ], $this->timezone),
        ]);
        return $this;
    }

    /**
     * Get sun details.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSunTimes(): Collection
    {
        return $this->sunTimes;
    }

    /**
     * Set temperature measurements.
     *
     * @param int|float $minTemperature
     * @param int|float $maxTemperature
     * @return $this
     */
    public function setTemperature(int|float $minTemperature, int|float $maxTemperature): self
    {
        $this->temperature = Collection::make([
            'min' => new Temperature(['value' => $minTemperature]),
            'max' => new Temperature(['value' => $maxTemperature])
        ]);
        return $this;
    }

    /**
     * Get temperature measurement.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTemperature(): Collection
    {
        return $this->temperature;
    }
}
