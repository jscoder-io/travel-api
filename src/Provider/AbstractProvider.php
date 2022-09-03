<?php

namespace Firman\TravelApi\Provider;

abstract class AbstractProvider implements ProviderInterface
{
    /** @var array Token, etc */
    public array $config;

    /**
     * Provider constructor
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}
