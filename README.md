## Travel API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/firman/travel-api.svg)](https://packagist.org/packages/firman/travel-api)
[![Total Downloads](https://img.shields.io/packagist/dt/firman/travel-api.svg)](https://packagist.org/packages/firman/travel-api)

Travel APIs fetch data from different providers, such as airlines, hotels, destinations, etc. Currently, it only supports **Amadeus API**.

## Installation

```bash
composer require firman/travel-api
```

## Usage

**Production environment**
```php
require 'vendor/autoload.php';

use Firman\TravelApi\Client;
use Firman\TravelApi\Provider\Provider;

$client = new Client(Provider::AMADEUS, [
    'client_id' => 'your_production_client_id',
    'client_secret' => 'your_production_client_secret'
]);
```

**Test environment**
```php
require 'vendor/autoload.php';

use Firman\TravelApi\Client;
use Firman\TravelApi\Provider\Provider;

$client = new Client(Provider::AMADEUS, [
    'client_id' => 'your_test_client_id',
    'client_secret' => 'your_test_client_secret',
    'env' => 'test'
]);
```

**Nearest Airport API**
```php
// Find nearest airport within radius 150 km in Madrid city
$response = $client->getNearestAirport(40.416775, -3.703790, 150);
```

**Airport/City Search API**
```php
// Search airport(s) which contain keyword 'Kennedy'
$response = $client->searchAirportOrCity('AIRPORT', 'Kennedy');
```

**Flight Checkin Links API**
```php
// Find British Airways checkin links
$response = $client->getFlightCheckinLinks('BA');
```

**Airline Code Lookup API**
```php
// Search airline by code for Garuda Indonesia
$response = $client->findAirlineByCode('GA');

// Search airline by code for British Airways and Garuda Indonesia
$response = $client->findAirlineByCode(['BA', 'GA']);
```

## Credits

- [Firman](https://github.com/jscoder-io)

## License

This package is licensed under the MIT License.