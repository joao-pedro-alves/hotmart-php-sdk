<?php

namespace Hotmart\Http\Endpoints;

use Hotmart\Http\RequestHandler;
use Hotmart\Http\Routes;

class Authentication extends Endpoint
{
    /**
     * @var string|null
     */
    private $token = null;

    /**
     * @return array
     */
    public function getToken()
    {
        if ($this->token) {
            return $this->token;
        }

        $options = RequestHandler::bindQueryParams([
            'grant_type' => 'client_credentials',
            'client_id' => $this->client->clientId(),
            'client_secret' => $this->client->clientSecret()
        ]);

        $options = RequestHandler::putHeaders([
            'Authorization' => 'Basic ' . $this->client->clientBasic()
        ], $options);

        $this->token = $this->http->request(
            self::POST,
            Routes::authentication()->token(),
            $options
        );

        return $this->token;
    }
}