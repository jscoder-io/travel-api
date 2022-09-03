<?php

namespace Firman\TravelApi\Api\Amadeus;

class NearestAirport extends AbstractAmadeus
{
    /** @var string API endpoint */
    protected $endpoint = '/v1/reference-data/locations/airports';
}
