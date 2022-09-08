<?php

use Firman\TravelApi\Api\Amadeus\AccessToken;
use Firman\TravelApi\Api\Amadeus\Environment;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

beforeEach(function () {
    $cache  = new FilesystemAdapter();
    $cache->delete('amadeus_token');
});

it('returns test base url', function () {
    Environment::setEnv('test');

    expect(Environment::getBaseUrl())
        ->toEqual('https://test.api.amadeus.com/');
});

it('returns production base url', function () {
    Environment::setEnv('production');

    expect(Environment::getBaseUrl())
        ->toEqual('https://api.amadeus.com/');
});

it('uses invalid client id and secret', function () {
    AccessToken::setConfig([]);

    expect(AccessToken::get())
        ->toBeTrue();
});
