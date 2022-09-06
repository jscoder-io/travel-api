<?php

namespace Firman\TravelApi\Provider;

use Firman\TravelApi\Api\Amadeus\AccessToken;
use Firman\TravelApi\Api\Amadeus\AirlineCodeLookup;
use Firman\TravelApi\Api\Amadeus\AirportOrCitySearch;
use Firman\TravelApi\Api\Amadeus\Environment;
use Firman\TravelApi\Api\Amadeus\FlightCheckinLinks;
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

    /**
     * The Airline Code Lookup API lets you find the name of an airline
     * by its IATA or ICAO airline code. You can search for multiple airline names
     * by including various airline codes in the same request.
     *
     * @param string|array $codes
     *
     * @return object
     */
    public function findAirlineByCode(string|array $codes)
    {
        return (new AirlineCodeLookup())->get([
            'airlineCodes' => implode(',', (array) $codes)
        ]);
    }

    /**
     * The Airport & City Search API finds airports and cities
     * that match a specific word or string of letters.
     * Using this API, you can automatically suggest airports based on
     * what the traveler enters in the search field.
     *
     * @param string|array $subType
     * @param string $keyword
     * @param string $countryCode
     * @param int $pageLimit
     * @param int $pageOffset
     * @param string $sort
     * @param string $view
     *
     * @return object
     */
    public function searchAirportOrCity(
        string|array $subType,
        string $keyword,
        string $countryCode = null,
        int $pageLimit = 10,
        int $pageOffset = 0,
        string $sort = 'analytics.travelers.score',
        string $view = 'FULL'
    ) {
        return (new AirportOrCitySearch())->get([
            'subType'     => implode(',', (array) $subType),
            'keyword'     => $keyword,
            'countryCode' => $countryCode,
            'sort'        => $sort,
            'view'        => $view,
            'page'        => [
                'limit'   => $pageLimit,
                'offset'  => $pageOffset,
            ],
        ]);
    }

    /**
     * The Flight Check-in Links API simplifies
     * the check-in process easy by providing a direct links
     * to the airline check-in page.
     *
     * @param string $code
     * @param string $language
     *
     * @return object
     */
    public function getFlightCheckinLinks(
        string $code,
        string $language = null
    ) {
        return (new FlightCheckinLinks())->get([
            'airlineCode' => $code,
            'language'    => $language
        ]);
    }
}
