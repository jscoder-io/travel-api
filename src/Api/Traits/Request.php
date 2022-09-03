<?php

namespace Firman\TravelApi\Api\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Utils;
use GuzzleHttp\Exception\RequestException;

trait Request
{
    /** @var string API Base URL */
    protected $baseUrl;

    /** @var string API endpoint */
    protected $endpoint;

    /** @var array Headers */
    protected $headers = [];

    /**
     * GET method
     *
     * @param array $params
     *
     * @return object
     */
    public function get(array $params = [])
    {
        try {
            return $this->jsonResponse(
                $this->client()->get(
                    $this->getUrl($params),
                    ['headers' => $this->headers]
                )
                ->getBody()
                ->getContents()
            );
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $this->jsonResponse(
                    $e->getResponse()->getBody()->getContents()
                );
            }
        }
    }

    /**
     * POST method
     *
     * @param array $params
     *
     * @return object
     */
    public function post(array $params = [])
    {
        try {
            return $this->jsonResponse(
                $this->client()->post(
                    $this->getUrl(),
                    [
                        'headers' => $this->headers,
                        'form_params' => $params
                    ]
                )
                ->getBody()
                ->getContents()
            );
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return $this->jsonResponse(
                    $e->getResponse()->getBody()->getContents()
                );
            }
        }
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function client()
    {
        return new Client();
    }

    /**
     * Get API url
     *
     * @param array $params
     *
     * @return string
     */
    public function getUrl(array $params = [])
    {
        return trim($this->baseUrl, '/')
            . $this->endpoint
            . (empty($params) ? '' : '?' . http_build_query($params))
        ;
    }

    /**
     * Decode json response as an object or array
     *
     * @param string $response
     * @param bool $asArray
     *
     * @return object|array
     */
    public function jsonResponse(string $response, bool $asArray = false)
    {
        return Utils::jsonDecode($response, $asArray);
    }
}
