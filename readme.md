# Charter724

[![License](https://poser.pugx.org/alirezahamedashki/charter724-api-laravel/license)](https://packagist.org/packages/alirezahamedashki/charter724-api-laravel)
[![Latest Stable Version](https://poser.pugx.org/alirezahamedashki/charter724-api-laravel/v/stable)](https://packagist.org/packages/alirezahamedashki/charter724-api-laravel)
[![Latest Unstable Version](https://poser.pugx.org/alirezahamedashki/charter724-api-laravel/v/unstable)](https://packagist.org/packages/alirezahamedashki/charter724-api-laravel)
[![Total Downloads](https://poser.pugx.org/alirezahamedashki/charter724-api-laravel/downloads)](https://packagist.org/packages/alirezahamedashki/charter724-api-laravel)

Laravel 5.* Integration with RESTful Api of Charter724

![Screen](https://raw.githubusercontent.com/alirezahamedashki/charter724-api-laravel/master/img/charter724.png)

## Installation

This package can be used in Laravel 5.4 or higher.
You can install the package via composer:

```bash
composer require alirezahamedashki/charter724-api-laravel
```
## Publish

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Adlino\Charter724\Charter724ServiceProvider" --tag=config
```

When published, [the `config/charter724.php` config file](https://github.com/alirezahamedashki/charter724-api-laravel/blob/master/src/Config/charter724.php) contains:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Api Access Token
    |--------------------------------------------------------------------------
    |
    | TODO:
    | Some Description About This
    */

    'access_token' => "PUT-YOUR-ACCESS-TOKEN-HERE",

    /*
    |--------------------------------------------------------------------------
    | Refresh Access Token
    |--------------------------------------------------------------------------
    |
    | TODO:
    | Some Description About This
    */

    'refresh_access_token' => false,

    /*
    |--------------------------------------------------------------------------
    | Api Base Uri
    |--------------------------------------------------------------------------
    |
    | TODO:
    | Some Description About This
    */

    'base_uri' => 'http://172.charter725.ir/‫‪APi/‫‪WebService/',

    /*
    |--------------------------------------------------------------------------
    | Api Authentication Uri
    |--------------------------------------------------------------------------
    |
    | TODO:
    | Some Description About This
    */

    'auth_uri' => "http://172.charter725.ir/‫‪APi/Login",

    /*
    |--------------------------------------------------------------------------
    | Table Names
    |--------------------------------------------------------------------------
    |
    | TODO:
    | Some Description About This
    */

    'table_names' => [
        'airports' => 'airports'
    ],

    /*
    |--------------------------------------------------------------------------
    | Column Names
    |--------------------------------------------------------------------------
    |
    | TODO:
    | Some Description About This
    */

    'column_names' => [

        /**
         * TODO:
         * Some Description About This
         */

        'code_int' => 'code_int',

        /**
         * TODO:
         * Some Description About This
         */

        'name_en' => 'name_en',

        /**
         * TODO:
         * Some Description About This
         */

        'name_fa' => 'name_fa',

        /**
         * TODO:
         * Some Description About This
         */

        'IATA_airport' => 'IATA_airport',

    ],

];
```

You can Generate Access Token via Command:

```bash
php artisan charter724:token
```

You can publish the migration with (We recommend):

```bash
php artisan vendor:publish --provider="Adlino\Charter724\Charter724ServiceProvider" --tag=migrations
php artisan migrate
```

You can Store Airport List to Database via Command:

```bash
php artisan charter724:airports
```

## Usage

If you have used migration to create table, you can use it to return airport list from database.

```php
$airports = Charter724::getAirportsFromDB();
```

But if you didn't use migration, you can use it.

```php
$airports = Charter724::getAirports();
```

Flights the next 15 days with the lowest price.

```php
$available15Days = Charter724::getAvailable15Days($fromIATA, $toIATA);

// example
$fromIATA = "THR";
$toIATA = "MHD";
$available15Days = Charter724::getAvailable15Days($fromIATA, $toIATA)
```

Available flights for the requested path.

```php
$availableFlights = Charter724::getAvailableFlights($fromIATA, $toIATA, $date);

// example
$fromIATA = "THR";
$toIATA = "MHD";
$date = "2019-05-17";
$availableFlights = Charter724::getAvailableFlights($fromIATA, $toIATA, $date);
```


