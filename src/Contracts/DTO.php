<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Contracts;

/**
 * Interface DTO.
 *
 * @package Rugaard\WeatherKit\Contracts
 */
interface DTO
{
    /**
     * Parse data.
     *
     * @param  array $data
     * @return void
     */
    public function parse(array $data): void;
}
