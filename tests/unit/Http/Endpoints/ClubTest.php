<?php

namespace Hotmart\Test\Http\Endpoints;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Hotmart\Http\Endpoints\Club;
use Hotmart\Http\Routes;
use Hotmart\Test\BaseTestCase;

class ClubTest extends BaseTestCase
{
    public function mockProvider()
    {
        return [[[
            'modules' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('ClubModules')),
            ]),
            'modulePages' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('ClubModulePages')),
            ]),
            'users' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('ClubUsers')),
            ]),
            'userLessons' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('ClubUserLessons')),
            ]),
        ]]];
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_modules($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['modules']);
        $response = $client->club()->modules('SUBDOMAIN', ['is_extra' => true]);

        $this->assertEquals(
            Club::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::club()->modules(),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('ClubModules'), true),
            $response
        );

        $query = self::getQueryString($container[1]);
        $this->assertContains('subdomain=SUBDOMAIN', $query);
        $this->assertContains('is_extra=1', $query);
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_module_pages($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['modulePages']);
        $response = $client->club()->modulePages('SUBDOMAIN', 'MODULE_ID');

        $this->assertEquals(
            Club::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::club()->modulePages('MODULE_ID'),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('ClubModulePages'), true),
            $response
        );

        $query = self::getQueryString($container[1]);
        $this->assertContains('subdomain=SUBDOMAIN', $query);
        $this->assertContains('module_id=MODULE_ID', $query);
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_users($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['users']);
        $response = $client->club()->users('SUBDOMAIN');

        $this->assertEquals(
            Club::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::club()->users(),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('ClubUsers'), true),
            $response
        );

        $query = self::getQueryString($container[1]);
        $this->assertContains('subdomain=SUBDOMAIN', $query);
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_user_lessons($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['userLessons']);
        $response = $client->club()->userLessons('SUBDOMAIN', 'USER_ID');

        $this->assertEquals(
            Club::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::club()->userLessons('USER_ID'),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('ClubUserLessons'), true),
            $response
        );

        $query = self::getQueryString($container[1]);
        $this->assertContains('subdomain=SUBDOMAIN', $query);
    }
}