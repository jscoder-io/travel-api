<?php

namespace Firman\TravelApi\Api\Amadeus;

use Firman\TravelApi\Api\Traits\Request as HttpRequest;

abstract class AbstractAmadeus
{
    use HttpRequest;

    /**
     * Amadeus API construction
     */
    public function __construct()
    {
        $this->baseUrl  = Environment::getBaseUrl();
        $this->headers  = array_merge(
            $this->headers,
            ['Authorization' => AccessToken::get()]
        );
    }
}
