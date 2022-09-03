<?php

namespace Firman\TravelApi\Provider;

use Firman\TravelApi\Api\Amadeus\AccessToken;
use Firman\TravelApi\Api\Amadeus\Environment;
use Firman\TravelApi\Api\Amadeus\NearestAirport;

class Amadeus extends AbstractProvider
{
    /**
     * Amadeus provider construction
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        Environment::setEnv($config['env'] ?? 'production');
        AccessToken::setConfig($config);
    }

    /**
     * Get nearest airport
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $radius
     * @param int $pageLimit
     * @param int $pageOffset
     * @param string $sort
     *
     * @return object
     */
    public function getNearestAirport(
        float $latitude,
        float $longitude,
        int $radius = 500,
        int $pageLimit = 10,
        int $pageOffset = 0,
        string $sort = 'relevance'
    ) {
        return (new NearestAirport())->get([
            'latitude'  => $latitude,
            'longitude' => $longitude,
            'radius'    => $radius,
            'sort'      => $sort,
            'page'      => [
                'limit'  => $pageLimit,
                'offset' => $pageOffset,
            ],
        ]);
    }
}
