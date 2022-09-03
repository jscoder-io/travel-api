<?php

namespace Firman\TravelApi;

use Firman\TravelApi\Exception\InvalidProviderException;
use Firman\TravelApi\Exception\UnknownProviderException;
use Firman\TravelApi\Provider\Provider;
use Firman\TravelApi\Provider\ProviderInterface;

class ProviderFactory
{
    /**
     * Create a provider instance
     *
     * @param string $provider
     * @param array $config
     *
     * @return ProviderInterface
     */
    public static function create(string $provider, array $config = [])
    {
        if (! array_key_exists($provider, Provider::$providers)) {
            throw new UnknownProviderException(sprintf(
                'Unknown provider \'%s\'',
                $provider
            ));
        }

        $instance = new Provider::$providers[$provider]($config);
        if (! $instance instanceof ProviderInterface) {
            throw new InvalidProviderException(sprintf(
                'Provider \'%s\' must be an instance of ProviderInterface',
                get_class($instance)
            ));
        }

        return $instance;
    }
}
