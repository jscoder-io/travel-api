<?php

namespace Firman\TravelApi;

class Client
{
    use Traits\ForwardsCalls;

    /** @var string Selected provider */
    public readonly string $provider;

    /** @var array Token, etc */
    public array $config;

    /** @var ProviderInterface|null Provider instance */
    private $instance;

    /**
     * Create a new instance.
     *
     * @param string $provider
     * @param array $config
     */
    public function __construct(string $provider, array $config = [])
    {
        $this->provider = $provider;
        $this->config   = $config;
    }

    /**
     * Travel API provider
     *
     * @return Provider\ProviderInterface
     */
    public function provider()
    {
        if (! $this->instance) {
            $this->instance = ProviderFactory::create($this->provider, $this->config);
        }
        return $this->instance;
    }

    /**
     * Handle dynamic method calls into the provider.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo($this->provider(), $method, $parameters);
    }
}
