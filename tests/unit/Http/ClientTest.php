<?php

namespace Hotmart\Test\Http;

use Hotmart\Http\Client;
use Hotmart\Test\BaseTestCase;
use Hotmart\Http\Endpoints\Transactions;
use Hotmart\Http\Endpoints\Subscriptions;
use Hotmart\Http\Endpoints\Authentication;

class ClientTest extends BaseTestCase
{
    /**
     * @var \Hotmart\Http\Client
     */
    private $client;

    public function setUp()
    {
        parent::__construct();

        $this->client = new Client('CLIENT_ID', 'CLIENT_SECRET', 'CLIENT_BASIC');
    }

    public function test_get_subscriptions_instance()
    {
        $this->assertTrue(method_exists($this->client, 'subscriptions'));
        $this->assertInstanceOf(Subscriptions::class, $this->client->subscriptions());
    }

    public function test_get_transactions_instance()
    {
        $this->assertTrue(method_exists($this->client, 'transactions'));
        $this->assertInstanceOf(Transactions::class, $this->client->transactions());
    }

    public function test_get_authentication_instance()
    {
        $this->assertTrue(method_exists($this->client, 'authentication'));
        $this->assertInstanceOf(Authentication::class, $this->client->authentication());
    }

    public function test_get_credentials()
    {
        $this->assertTrue(method_exists($this->client, 'clientId'));
        $this->assertTrue(method_exists($this->client, 'clientSecret'));
        $this->assertTrue(method_exists($this->client, 'clientBasic'));
        
        $this->assertEquals('CLIENT_ID', $this->client->clientId());
        $this->assertEquals('CLIENT_SECRET', $this->client->clientSecret());
        $this->assertEquals('CLIENT_BASIC', $this->client->clientBasic());
    }
}