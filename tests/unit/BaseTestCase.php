<?php

namespace Hotmart\Test;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Hotmart\Http\Client;
use Hotmart\Http\Http;

abstract class BaseTestCase extends TestCase
{
    /**
     * @param string $mockName
     *
     * @return string
     */
    protected static function jsonMock($mockName)
    {
        return file_get_contents(__DIR__ . "/Mocks/Endpoints/$mockName.json");
    }

    /**
     * @param array $container
     * @param \GuzzleHttp\Handler\MockHandler $mock
     */
    protected static function buildClient(&$container, $mock)
    {
        $history = Middleware::history($container);

        $handler = HandlerStack::create($mock);
        $handler->push($history);

        $http = new Http(['handler' => $handler]);
        return new Client('', '', '', ['http' => $http]);
    }

    /**
     * @param array $container
     *
     * @return string
     */
    protected static function getRequestUri($container)
    {
        return $container['request']->getUri()->getPath();
    }

    /**
     * @param array $container
     *
     * @return string
     */
    protected static function getRequestMethod($container)
    {
        return $container['request']->getMethod();
    }

    /**
     * @param array $container
     *
     * @return string
     */
    protected static function getQueryString($container)
    {
        return $container['request']->getUri()->getQuery();
    }

    /**
     * @param array $container
     *
     * @return string
     */
    protected static function getBody($container)
    {
        $requestBody = $container['request']->getBody();
        $bodySize = $requestBody->getSize();

        return $requestBody->read($bodySize);
    }
}
