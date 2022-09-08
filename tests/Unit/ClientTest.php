<?php

use Firman\TravelApi\Client;
use Firman\TravelApi\Exception\UnknownProviderException;
use Firman\TravelApi\Provider\Amadeus;
use Firman\TravelApi\Provider\Provider;

test('Unknown provider', function () {
    expect(fn() => (new Client('unknown'))->provider())
        ->toThrow(UnknownProviderException::class);
});

test('Amadeus provider', function () {
    expect((new Client(Provider::AMADEUS))->provider())
        ->toBeInstanceOf(Amadeus::class);
});

test('Bad method call exception', function () {
    expect(fn() => (new Client(Provider::AMADEUS))->badMethod())
        ->toThrow(BadMethodCallException::class);
});
