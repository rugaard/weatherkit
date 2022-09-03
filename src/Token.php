<?php

declare(strict_types=1);

namespace Rugaard\WeatherKit;

use Firebase\JWT\JWT;
use OpenSSLAsymmetricKey;
use Rugaard\WeatherKit\Exceptions\DecodingKeyFailedException;
use Rugaard\WeatherKit\Exceptions\KeyNotFoundException;
use Rugaard\WeatherKit\Exceptions\TokenFailedException;
use Throwable;

use function file_exists;
use function file_get_contents;
use function openssl_pkey_get_private;
use function time;

/**
 * Token.
 *
 * @package Rugaard\WeatherKit
 */
class Token
{
    /**
     * JWT token.
     *
     * @var string
     */
    protected string $token;

    /**
     * Token constructor.
     *
     * @param string $pathToKey
     * @param string $keyId
     * @param string $appIdPrefix
     * @param string $bundleId
     * @throws \Rugaard\WeatherKit\Exceptions\DecodingKeyFailedException
     * @throws \Rugaard\WeatherKit\Exceptions\KeyNotFoundException
     * @throws \Rugaard\WeatherKit\Exceptions\TokenFailedException
     */
    public function __construct(string $pathToKey, string $keyId, string $appIdPrefix, string $bundleId)
    {
        if (!file_exists(filename: $pathToKey)) {
            throw new KeyNotFoundException(message: 'Invalid path to key.', code: 400);
        }

        // Decode private key
        $key = $this->decodeKey(filename: $pathToKey);

        try {
            // Generate token.
            $this->token = JWT::encode(payload: [
                'iss' => $appIdPrefix,
                'sub' => $bundleId,
                'iat' => time(),
                'exp' => time() + 3600,
            ], head: [
                'id' => $appIdPrefix . '.' . $bundleId
            ], keyId: $keyId, key: $key, alg: 'ES256');
        } catch (Throwable $e) {
            throw new TokenFailedException(message: 'Could not generate token', code: 400, previous: $e);
        }
    }

    /**
     * Decode private key.
     *
     * @param string $filename
     * @return \OpenSSLAsymmetricKey
     * @throws \Rugaard\WeatherKit\Exceptions\DecodingKeyFailedException
     */
    protected function decodeKey(string $filename): OpenSSLAsymmetricKey
    {
        $key = openssl_pkey_get_private(private_key: file_get_contents(filename: $filename));
        if (!$key) {
            throw new DecodingKeyFailedException(message: 'Could not decode key.', code: 400);
        }

        return $key;
    }

    /**
     * Get JWT token.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * __toString.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getToken();
    }
}
