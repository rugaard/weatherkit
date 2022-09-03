![Banner](https://banners.beyondco.de/WeatherKit.png?theme=light&packageManager=composer+require&packageName=rugaard%2Fweatherkit&pattern=topography&style=style_1&description=Get+latest+weather+forecasts+and+alerts+from+Apple+WeatherKit+API.&md=1&showWatermark=0&fontSize=125px&images=sun)
![PHP 8.1](https://img.shields.io/badge/php-8.1-blue) [![Coding style](https://github.com/rugaard/weatherkit/actions/workflows/coding-style.yaml/badge.svg)](https://github.com/rugaard/weatherkit/actions/workflows/coding-style.yaml) [![Tests](https://github.com/rugaard/weatherkit/actions/workflows/tests.yaml/badge.svg)](https://github.com/rugaard/weatherkit/actions/workflows/tests.yaml) [![Coverage](https://codecov.io/gh/rugaard/weatherkit/branch/main/graph/badge.svg?token=ZMHA4EUTM4)](https://codecov.io/gh/rugaard/weatherkit) ![License](https://img.shields.io/github/license/rugaard/weatherkit)

#### ⚠️ DISCLAIMER ⚠️
_Apple's WeatherKit REST API is currently still in beta and the documentation is not fully up-to-date._ 

_During development undocumented responses and values were encountered, but have been handled to the best of what information was available at the time._ 

## 📖 Table of contents

* [Features](#-features)
* [Installation](#-installation)
  * [Laravel provider](#laravel-provider)
* [Authentication](#-authentication)
  * [Create new App ID](#create-new-app-id)
  * [Create new key](#create-new-key)
* [Usage](#%EF%B8%8F-usage)
  * [Generate access token](#generate-access-token)
  * [Standalone](#standalone)
  * [With Laravel](#with-laravel)
* [Documentation](#-documentation)
* [License](#-license)

## 🚀 Features

- **Multiple forecast types**
  - Current weather
  - Next hour (minute-by-minute) forecast 🔹
  - Hourly forecast
  - Daily forecast
- **Weather alerts** 🔸
- **Built-in unit conversions**
  - Length
  - Pressure
  - Speed
  - Temperature

_🔹 = In countries where available._
_🔸 = When a country code is provided._

## 📦 Installation
You can install the package via [Composer](https://getcomposer.org/), by using the following command:
```shell
composer require rugaard/weatherkit
```

### Laravel provider
This package comes with a out-of-the-box Service Provider for the [Laravel](http://laravel.com) framework.
If you're using a newer version of Laravel (`>= 5.5`) then the service provider will loaded automatically.

Are you using an older version, then you need to manually add the service provider to the `config/app.php` file:

```php
'providers' => [
    Rugaard\WeatherKit\Providers\LaravelServiceProvider::class,
]
```

#### Configuration

The default package configuration are setup to use the following environment variables.

| Variable name                           | Default                         | Description                        |
|-----------------------------------------|---------------------------------|------------------------------------|
| `RUGAARD_WEATHERKIT_AUTH_FILEPATH`      |                                 | Path to the `.p8` key file.        |
| `RUGAARD_WEATHERKIT_AUTH_KEY_ID`        |                                 | Key ID matching the `.p8` key file |
| `RUGAARD_WEATHERKIT_AUTH_APP_PREFIX_ID` |                                 | App Prefix ID (aka. Team ID)       |
| `RUGAARD_WEATHERKIT_AUTH_BUNDLE_ID`     |                                 | Bundle ID of your App ID.          |
| `RUGAARD_WEATHERKIT_LANGUAGE_CODE`      | `config('app.locale', 'en')`    | Language code                      |
| `RUGAARD_WEATHERKIT_TIMEZONE`           | `config('app.timezone', 'UTC')` | Set timezone of timestamps         |

Should you need to change the default configuration, you can publish the configuration file to your project.

```shell
php artisan vendor:publish --provider=\Rugaard\WeatherKit\Providers\LaravelServiceProvider
```

## 🔑 Authentication

After Apple bought [DarkSky](https://blog.darksky.net/) and turned into [WeatherKit](https://developer.apple.com/weatherkit/), the API now requires authentication. To be able to authenticate, you are required to be part of [Apple's Developer Program](https://developer.apple.com/programs/).

Once you're enrolled with Apple Developer Program, you must register a new **App ID** and create a new **Key**.

### Create new App ID

To create a new App ID, you must [register your app on this form](https://developer.apple.com/account/resources/identifiers/bundleId/add/bundle). Enter a short description and give your app a unique bundle ID (reverse url).

**Example:**
| Description | Bundle ID |
| ------------- | ------------- |
| Latest weather forecast  | `com.forecast.weather`  |

When you are done filling out the required fields, you need **☑️ WeatherKit** under the **Capabilities** and **App Services** tabs.

Afterwards, click the blue **Continue** button and you're done.

### Create new key

To create a new key, you must [generate it from this form](https://developer.apple.com/account/resources/authkeys/add). 

Give your key a name and make sure to enable **☑️ WeatherKit**. When you're done, click the blue **Continue** button. You'll be redirected to a confirmation page, where you click the blue **Register** button.

Then, download your key as physical file to your machine. It's required for authenticating with the API.

And that's it. You're done.

## ⚙️ Usage

Before the client can be instantiated, it requires an access token. To generate an access token, Apple requires you to create an App ID and Key, which you to download as a physical file. 

If you have not done these things yet, you can follow the guide in the [🔑 Authentication](#-authentication) section of this README.

### Generate access token

To generate an access token, you're going to need a few things:
- The `App ID Prefix` and `Bundle ID` that you created in [Create new App ID](#create-new-app-id) section. 
- The `Key ID` of the key, that you created in the [Create new key](#create-new-key) section.
- The physical key you downloaded in the [Create new key](#create-new-key) section.

```php
<?php

use Rugaard\WeatherKit\Token;

// Details from "Create new App ID" section.
$appIdPrefix = 'O9876S4E2I';
$bundleId = 'com.forecast.weather';

// Details from "Create new key" section.
$pathToKey = 'credentials/AuthKey_I2E4S6789O.p8'
$keyId = 1234567890;

// Create Token instance.
$token = new Token($pathToKey, $keyId, $appIdPrefix, $bundleId);
```

When a `Token` instance has been created, you can retrieve the generated access token in two different ways.

```php
// Method 1: getToken()
$accessToken = $token->getToken();

// Method 2: __toString()
$accessToken = (string) $token;
```

### Standalone

Before we are able to make any requests to the API, we need to instantiate the HTTP client. A client can be instantiated with or without a default location.

```php
<?php

use Rugaard\WeatherKit\Client;

// Instantiate client without default location.
$weatherKit = new Client($token->getToken(), null, null, null);

// Instantiate client with default location.
$weatherKit = new Client((string) $token, 55.6736841, 12.5681471, 'dk');

// Instantiate client with default location and local language/timezone.
$weatherKit = new Client((string) $token, 55.6736841, 12.5681471, 'dk', 'da', 'Europe/Copenhagen');

```

When a client has been instantiated, it's possible to change the location, language and timezone, if needed.

```php
// Change location to London.
$weatherKit->setLocation(51.5286416, -0.1015987);

// Country code is optional
// but required to retrieve weather alerts.
$weatherKit->setLocation(51.5286416, -0.1015987, 'gb');

// Change language to German.
$weatherKit->setLanguage('de');

// Change timezone to Paris.
$weatherKit->setTimezone('Europe/Paris');
```

You can either retrieve all forecasts at once or individually.

```php
// Get all forecasts at once.
/* @var $forecasts \Illuminate\Support\Collection */
$forecasts = $weatherKit->weather();

// Get current forecast.
/* @var $forecast \Rugaard\WeatherKit\DTO\DataSets\Currently */
$forecast = $weatherKit->currently();

// Get next hour (minute-by-minute) forecast.
/* @var $forecast \Rugaard\WeatherKit\DTO\DataSets\NextHour */
$forecast = $weatherKit->nextHour();

// Get hourly forecast.
/* @var $forecast \Rugaard\WeatherKit\DTO\DataSets\Hourly */
$forecast = $weatherKit->hourly();

// Get daily forecast.
/* @var $forecast \Rugaard\WeatherKit\DTO\DataSets\Daily */
$forecast = $weatherKit->daily();
```

When a country code has been set with the client, you are able to retrieve weather alerts, should there be any associated with the location.

```php
// Get weather alerts.
/* @var $alerts \Rugaard\WeatherKit\DTO\DataSets\Alerts */
$alerts = $weatherKit->alerts();

// Get detailed information about a specific alert.
/* @var $alertDetails \Rugaard\WeatherKit\DTO\Forecasts\AlertDetails */
$alertDetails = $weatherKit->alert($alerts->getData()->first()->getId());
```

### With Laravel

When using this package with Laravel, the client will automatically be instantiated and added to the service container. 

By default the settings are set via environment variables, described in the [📦 Installation](#laravel-provider) section. Should you want to use something else than environment variables, you can change it in the config file at `config/weatherkit.php`.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Rugaard\WeatherKit\Client as WeatherKit;

class WeatherController extends Controller
{
    /**
     * Get all forecasts at once.
     *
     * @param \Rugaard\WeatherKit\Client $weatherKit
     */
    public function forecast(WeatherKit $weatherKit)
    {
        $forecasts = $weatherKit->setLocation(55.6736841, 12.5681471, 'dk')->weather();
    }
    
    /**
     * Get current weather measurements.
     *
     * @param \Rugaard\WeatherKit\Client $weatherKit
     */
    public function currently(WeatherKit $weatherKit)
    {
        $forecasts = $weatherKit->setLocation(55.6736841, 12.5681471, 'dk')->currently();
    }
    
    /**
     * Get next hour (minute-by-minute) forecast.
     *
     * @param \Rugaard\WeatherKit\Client $weatherKit
     */
    public function nextHour(WeatherKit $weatherKit)
    {
        $forecasts = $weatherKit->setLocation(55.6736841, 12.5681471, 'dk')->nextHour();
    }
    
    /**
     * Get hourly forecast.
     *
     * @param \Rugaard\WeatherKit\Client $weatherKit
     */
    public function hourly(WeatherKit $weatherKit)
    {
        $forecasts = $weatherKit->setLocation(55.6736841, 12.5681471, 'dk')->hourly();
    }
    
    /**
     * Get daily forecast.
     *
     * @param \Rugaard\WeatherKit\Client $weatherKit
     */
    public function daily(WeatherKit $weatherKit)
    {
        $forecasts = $weatherKit->setLocation(55.6736841, 12.5681471, 'dk')->daily();
    }
}
```

It's possible to set/change default settings on the `Client` by setting them in the `boot()` method of the `AppServiceProvider`. This way, you can avoid setting location/language/timezone on each request.

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Rugaard\WeatherKit\Client as WeatherKit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(WeatherKit $weatherKit)
    {
        // Change location to London.
        $weatherKit->setLocation(51.5286416, -0.1015987);
        
        // Country code is optional
        // but required to retrieve weather alerts.
        $weatherKit->setLocation(51.5286416, -0.1015987, 'gb');
        
        // Change language to German.
        $weatherKit->setLanguage('de');
        
        // Change timezone to Paris.
        $weatherKit->setTimezone('Europe/Paris');
    }
}
```

## 📚 Documentation

For more in-depth documentation about forecast types, measurements and more, please refer to the [Wiki](https://github.com/rugaard/weatherkit/wiki).

## 🚓 License

This package is licensed under [MIT](https://github.com/rugaard/weatherkit/blob/main/LICENSE.md).

Since this package uses an Apple service, you need follow the guidelines and requirements for attributing Apple weather data. For more details, view the [attribution requirements on Apple's website](https://developer.apple.com/weatherkit/get-started/#attribution-requirements).
