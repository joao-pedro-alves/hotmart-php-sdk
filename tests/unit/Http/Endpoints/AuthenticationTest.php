<?php

namespace Hotmart\Test\Http\Endpoints;

use GuzzleHttp\Psr7\Response;
use Hotmart\Test\BaseTestCase;
use GuzzleHttp\Handler\MockHandler;
use Hotmart\Http\Endpoints\Authentication;

class AuthenticationTest extends BaseTestCase
{
    public function mockProvider()
    {
        return [[[
            'authentication' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], '[]'),
            ]),
        ]]];
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_token($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['authentication']);
        $response = $client->authentication()->getToken();

        $this->assertEquals(
            Authentication::POST,
            self::getRequestMethod($container[0])
        );

        $this->assertEquals(
            '/security/oauth/token',
            self::getRequestUri($container[0])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('Authentication'), true),
            $response
        );

        $response = $client->authentication()->getToken();

        $this->assertEquals(
            json_decode(self::jsonMock('Authentication'), true),
            $response
        );
    }
}