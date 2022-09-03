<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\DTO;

/**
 * Coordinate.
 *
 * @package Rugaard\WeatherKit\DTO
 */
class Coordinate extends AbstractDTO
{
    /**
     * Latitude position.
     *
     * @var float|null
     */
    protected ?float $latitude;

    /**
     * Longitude position.
     *
     * @var float|null
     */
    protected ?float $longitude;

    /**
     * Parse data.
     *
     * @param  array $data
     * @return void
     */
    public function parse(array $data): void
    {
        $this->setLatitude(latitude: $data['latitude'])
             ->setLongitude(longitude: $data['longitude']);
    }

    /**
     * Set latitude position.
     *
     * @param float|null $latitude
     * @return $this
     */
    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get latitude position.
     *
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * Set longitude position.
     *
     * @param float|null $longitude
     * @return $this
     */
    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get longitude position.
     *
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * __toString.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getLatitude() . ',' . $this->getLongitude();
    }
}
