<?php

use Firman\TravelApi\Api\Amadeus\Environment;

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
