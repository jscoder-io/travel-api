<?php

use Firman\TravelApi\Client;
use Firman\TravelApi\Provider\Provider;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

beforeEach(function () {
    $this->invalidConfig = [
        'client_id'     => '1nV4liD',
        'client_secret' => '1nV4liD',
        'env'           => 'test'
    ];

    $this->validConfig = [
        'client_id'     => $_ENV['AMADEUS_CLIENT_ID'],
        'client_secret' => $_ENV['AMADEUS_CLIENT_SECRET'],
        'env'           => $_ENV['AMADEUS_ENV']
    ];

    $cache  = new FilesystemAdapter();
    $cache->delete('amadeus_token');
});

test('401 Unauthorized', function () {
    $client = new Client(Provider::AMADEUS, $this->invalidConfig);

    expect($client->getFlightCheckinLinks('BA'))
        ->toHaveProperty('errors');
});

test('Flight checkin links', function () {
    $client = new Client(Provider::AMADEUS, $this->validConfig);

    expect($client->getFlightCheckinLinks('BA'))
        ->toHaveProperties(['meta', 'data']);
});

test('Search airport or city', function () {
    $client = new Client(Provider::AMADEUS, $this->validConfig);

    expect($client->searchAirportOrCity('AIRPORT', 'Kennedy'))
        ->toHaveProperties(['meta', 'data']);
});

test('Find airline by single code', function () {
    $client = new Client(Provider::AMADEUS, $this->validConfig);

    expect($client->findAirlineByCode('BA'))
        ->toHaveProperties(['meta', 'data']);
});

test('Find airline by multiple codes', function () {
    $client = new Client(Provider::AMADEUS, $this->validConfig);

    expect($client->findAirlineByCode(['BA', 'GA']))
        ->toHaveProperties(['meta', 'data']);
});

test('Find nearest airport', function () {
    $client = new Client(Provider::AMADEUS, $this->validConfig);

    expect($client->getNearestAirport(40.416775, -3.703790, 150))
        ->toHaveProperties(['meta', 'data']);
});
