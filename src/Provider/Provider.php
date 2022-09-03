<?php

namespace Firman\TravelApi\Provider;

class Provider
{
    /** Provider code for Amadeus */
    public const AMADEUS = 'amadeus';

    /** @var array name => class pairs */
    public static $providers = [
        self::AMADEUS => Amadeus::class,
    ];
}
