<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Exceptions;

use GuzzleHttp\Exception\ServerException as GuzzleServerException;

/**
 * Class ServerException
 *
 * @package Rugaard\WeatherKit\Exceptions
 */
class ServerException extends GuzzleServerException
{
}
