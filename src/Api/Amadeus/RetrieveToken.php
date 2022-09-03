<?php

namespace Firman\TravelApi\Api\Amadeus;

class RetrieveToken extends AbstractAmadeus
{
    /** @var string API endpoint */
    protected $endpoint = '/v1/security/oauth2/token';

    public function __construct()
    {
        $this->baseUrl  = Environment::getBaseUrl();
        $this->headers = [];
    }
}
