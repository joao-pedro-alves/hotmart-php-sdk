<?php

namespace Hotmart\Http;

use Hotmart\Http\Endpoints\Authentication;
use Hotmart\Http\Endpoints\Subscriptions;

class Client
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $clientBasic;

    /**
     * @var \Hotmart\Http\Http
     */
    private $http;

    /**
     * @var \Hotmart\Http\Endpoints\Authentication
     */
    private $authentication;

    /**
     * @var \Hotmart\Http\Endpoints\Subscriptions
     */
    private $subscriptions;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $clientBasic
     * @param array $extras
     */
    public function __construct($clientId, $clientSecret, $clientBasic, $extras = [])
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->clientBasic = $clientBasic;

        $extras = array_merge([
            'http' => null,
        ], $extras);

        $this->http = $extras['http'] ?: new Http();

        $this->authentication = new Authentication($this, $this->http);
        $this->subscriptions = new Subscriptions($this, $this->http);
    }

    /**
     * @return \Hotmart\Http\Endpoints\Subscriptions
     */
    public function subscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * @return \Hotmart\Http\Endpoints\Authentication
     */
    public function authentication()
    {
        return $this->authentication;
    }

    /**
     * @return string
     */
    public function clientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function clientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function clientBasic()
    {
        return $this->clientBasic;
    }
}