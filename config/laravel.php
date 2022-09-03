<?php

declare(strict_types=1);

return [
    /**
     * TODO
     */
    'auth' => [
        'filepath' => base_path(env('RUGAARD_WEATHERKIT_AUTH_FILEPATH', '')),
        'keyId' => env('RUGAARD_WEATHERKIT_AUTH_KEY_ID'),
        'appPrefixId' => env('RUGAARD_WEATHERKIT_AUTH_APP_PREFIX_ID'),
        'bundleId' => env('RUGAARD_WEATHERKIT_AUTH_BUNDLE_ID'),
    ],

    /**
     * TODO
     */
    'languageCode' => env('RUGAARD_WEATHERKIT_LANGUAGE_CODE', config('app.locale', 'en')),

    /**
     * TODO
     */
    'timezone' => env('RUGAARD_WEATHERKIT_TIMEZONE', config('app.timezone', 'UTC')),
];
