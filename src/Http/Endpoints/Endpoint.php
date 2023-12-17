<?php

namespace Hotmart\Http\Endpoints;

use Hotmart\Http\RequestHandler;

abstract class Endpoint
{
    /**
     * @var string
     */
    const POST = 'POST';

    /**
     * @var string
     */
    const GET = 'GET';

    /**
     * @var string
     */
    const PUT = 'PUT';

    /**
     * @var string
     */
    const PATCH = 'PATCH';

    /**
     * @var string
     */
    const DELETE = 'DELETE';

    /**
     * @var \Hotmart\Http\Client
     */
    protected $client;

    /**
     * @var \Hotmart\Http\Http
     */
    protected $http;

    /**
     * @param \Hotmart\Http\Client $client
     * @param \Hotmart\Http\Http $http
     */
    public function __construct($client, $http)
    {
        $this->client = $client;
        $this->http = $http;
    }

    /**
     * @var array $params
     * @var array $options
     */
    protected function bindQueryParams($params, $options = [])
    {
        return RequestHandler::bindQueryParams($params, $options);
    }

    /**
     * @var array $params
     * @var array $options
     */
    protected function bindJson($params, $options = [])
    {
        return RequestHandler::bindJson($params, $options);
    }

    /**
     * 
     * @return string
     */
    protected function bindToken($options = [])
    {
        $token = $this->client->authentication()->getToken()['access_token'];

        return RequestHandler::putHeaders([
            'Authorization' => 'Bearer ' . $token
        ], $options);
    }
}