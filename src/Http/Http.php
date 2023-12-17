<?php

namespace Hotmart\Http;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Http
{
    /**
     * @var string
     */
    const BASE_URI = 'https://developers.hotmart.com';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->client = new HttpClient($options);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     */
    public function request($method, $uri, $options = [])
    {
        try {
            $options['base_uri'] = self::BASE_URI;
    
            $response = $this->client->request(
                $method,
                $uri,
                $options
            );
    
            $rawBody = (string)$response->getBody();
    
            return json_decode($rawBody, true);
        } catch (ClientException $e) {
            ResponseHandler::failure($e);
        } catch (ServerException $e) {
            ResponseHandler::failure($e);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}