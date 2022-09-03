<?php

namespace Firman\TravelApi\Api\Amadeus;

class Environment
{
    /** @var string Environment */
    private static $env;

    /** @var string Production base url  */
    private static $prodBaseUrl = 'https://api.amadeus.com/';

    /** @var string Test base url  */
    private static $testBaseUrl = 'https://test.api.amadeus.com/';

    /**
     * Set environment
     *
     * @param string $mode
     */
    public static function setEnv(string $mode)
    {
        self::$env = $mode;
    }

    /**
     * Get base url
     *
     * @return string
     */
    public static function getBaseUrl()
    {
        return self::$env === 'production'
            ? self::$prodBaseUrl
            : self::$testBaseUrl
        ;
    }
}
