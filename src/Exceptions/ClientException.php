<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Exceptions;

use GuzzleHttp\Exception\ClientException as GuzzleClientException;

/**
 * Class ClientException
 *
 * @package Rugaard\WeatherKit\Exceptions
 */
class ClientException extends GuzzleClientException
{
}
