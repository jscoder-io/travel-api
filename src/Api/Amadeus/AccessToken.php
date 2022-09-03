<?php

namespace Firman\TravelApi\Api\Amadeus;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class AccessToken
{
    /** @var array Config */
    private static $config;

    /**
     * Set config
     *
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        self::$config = $config;
    }

    /**
     * Get access token from cache. In case cache is expired,
     * retrieve from server.
     *
     * @return string
     */
    public static function get()
    {
        $cache  = new FilesystemAdapter();
        $config = self::$config;

        return $cache->get('amadeus_token', function (ItemInterface $item) use ($config) {
            $response = (new RetrieveToken())->post([
                'grant_type'    => 'client_credentials',
                'client_id'     => $config['client_id'] ?? null,
                'client_secret' => $config['client_secret'] ?? null
            ]);
            if (isset($response->error)) {
                $item->expiresAfter(1);
                return true;
            }
            $item->expiresAfter($response->expires_in);
            return $response->token_type .' '. $response->access_token;
        });
    }
}
