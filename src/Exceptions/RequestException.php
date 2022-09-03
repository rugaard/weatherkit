<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit\Exceptions;

use GuzzleHttp\Exception\TransferException as GuzzleTransferException;

/**
 * Class RequestException
 *
 * @package Rugaard\WeatherKit\Exceptions
 */
class RequestException extends GuzzleTransferException
{
}
