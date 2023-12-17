<?php

namespace Hotmart\Test\Endpoints;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Hotmart\Exceptions\HotmartException;
use Hotmart\Http\Endpoints\Subscriptions;

class SubscriptionsTest extends BaseTestCase
{
    public function mockProvider()
    {
        return [[[
            'subscriptions' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('Subscriptions')),
                new Response(200, [], '[]'),
            ]),
            'subscriptionsSummary' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('SubscriptionsSummary')),
                new Response(200, [], '[]'),
            ]),
            'subscriptionPurchases' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('SubscriptionPurchases')),
                new Response(200, [], '[]'),
            ]),
            'subscriptionCancel' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('SubscriptionCancel')),
                new Response(200, [], '[]'),
                new Response(400, [], '[]'),
            ]),
            'subscriptionReactivate' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('SubscriptionReactivate')),
                new Response(200, [], '[]'),
                new Response(400, [], '[]'),
            ]), 
            'subscriptionReactivateList' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('SubscriptionReactivateList')),
                new Response(200, [], '[]'),
            ]),
            'subscriptionCancelList' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('SubscriptionCancelList')),
                new Response(200, [], '[]'),
            ]),
            'subscriptionChangeChargeDay' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], ''),
            ]),
        ]]];
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_subscriptions($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['subscriptions']);
        $response = $client->subscriptions()->get();

        $this->assertEquals(
            Subscriptions::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            '/payments/api/v1/subscriptions',
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('Subscriptions'), true),
            $response
        );

        $params = [
            'max_results' => 5,
            'page_token' => 'abc',
            'product_id' => '123',
            'plan' => 'plan',
            'plan_id' => '333',
            'accession_date' => '111',
            'end_accession_date' => '222',
            'status' => 'ACTIVE',
            'subscriber_code' => 'code',
            'subscriber_email' => 'a@a.com',
            'transaction' => 't123',
            'trial' => 1,
            'cancelation_date' => '111111',
            'end_cancelation_date' => '22222',
            'date_next_charge' => '333333',
            'end_date_next_charge' => '444444'
        ];

        $response = $client->subscriptions()->get($params);

        $query = self::getQueryString($container[2]);

        foreach (explode('&', http_build_query($params)) as $param) {
            $this->assertContains($param, $query);
        }
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_subscriptions_summary($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['subscriptionsSummary']);
        $response = $client->subscriptions()->summary();

        $this->assertEquals(
            Subscriptions::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            '/payments/api/v1/subscriptions/summary',
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('SubscriptionsSummary'), true),
            $response
        );

        $params = [
            'max_results' => 5,
            'page_token' => 'abc',
            'product_id' => '123',
            'subscriber_code' => 'code',
            'accession_date' => '111',
            'end_accession_date' => '222'
        ];
        $response = $client->subscriptions()->summary($params);

        $query = self::getQueryString($container[2]);

        foreach (explode('&', http_build_query($params)) as $param) {
            $this->assertContains($param, $query);
        }
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_subscription_purchases($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['subscriptionPurchases']);
        $response = $client->subscriptions()->purchases('SUBSCRIBER_CODE');

        $this->assertEquals(
            Subscriptions::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            '/payments/api/v1/subscriptions/SUBSCRIBER_CODE/purchases',
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('SubscriptionPurchases'), true),
            $response
        );

        $params = [
            'transaction' => 'abc',
            'approved_date' => '1111',
            'payment_engine' => 'HotPay',
            'status' => 'APPROVED',
            'price' => [
                'value' => 19.99,
                'currency_code' => 'BRL'
            ],
            'payment_type' => 'CASH_PAYMENT',
            'payment_method' => 'BILLET',
            'recurrency_number' => 12,
            'under_warranty' => 1,
            'purchase_subscription' => 1,
        ];

        $response = $client->subscriptions()->purchases('SUBSCRIBER_CODE', $params);

        $query = self::getQueryString($container[2]);

        foreach (explode('&', http_build_query($params)) as $param) {
            $this->assertContains($param, $query);
        }
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_cancel_subscription($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['subscriptionCancel']);
        $response = $client->subscriptions()->cancel('SUBSCRIBER_CODE');

        $this->assertEquals(
            Subscriptions::POST,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            '/payments/api/v1/subscriptions/SUBSCRIBER_CODE/cancel',
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('SubscriptionCancel'), true),
            $response
        );

        $response = $client->subscriptions()->cancel('SUBSCRIBER_CODE', [
            'send_mail' => false
        ]);

        $this->assertJsonStringEqualsJsonString('{"send_mail": false}', self::getBody($container[2]));

        $this->expectException(HotmartException::class);

        $client->subscriptions()->cancel('SUBSCRIBER_CODE');
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_reactivate_subscription($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['subscriptionReactivate']);
        $response = $client->subscriptions()->reactivate('SUBSCRIBER_CODE');

        $this->assertEquals(
            Subscriptions::POST,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            '/payments/api/v1/subscriptions/SUBSCRIBER_CODE/reactivate',
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('SubscriptionReactivate'), true),
            $response
        );

        $response = $client->subscriptions()->reactivate('SUBSCRIBER_CODE', [
            'charge' => true
        ]);

        $this->assertJsonStringEqualsJsonString('{"charge": true}', self::getBody($container[2]));

        $this->expectException(HotmartException::class);

        $client->subscriptions()->reactivate('SUBSCRIBER_CODE');
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_reactivate_subscription_list($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['subscriptionReactivateList']);
        $response = $client->subscriptions()->reactivateList(['SUBSCRIBER_CODE']);

        $this->assertEquals(
            Subscriptions::POST,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            '/payments/api/v1/subscriptions/reactivate',
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('SubscriptionReactivateList'), true),
            $response
        );

        $this->assertContains('"subscriber_code":["SUBSCRIBER_CODE"]', self::getBody($container[1]));

        $client->subscriptions()->reactivateList(['SUBSCRIBER_CODE'], [
            'charge' => true
        ]);

        $this->assertContains('"charge":true', self::getBody($container[2]));
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_cancel_subscription_list($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['subscriptionCancelList']);
        $response = $client->subscriptions()->cancelList(['SUBSCRIBER_CODE']);

        $this->assertEquals(
            Subscriptions::POST,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            '/payments/api/v1/subscriptions/cancel',
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('SubscriptionCancelList'), true),
            $response
        );

        $this->assertContains('"subscriber_code":["SUBSCRIBER_CODE"]', self::getBody($container[1]));

        $client->subscriptions()->reactivateList(['SUBSCRIBER_CODE'], [
            'send_mail' => false
        ]);

        $this->assertContains('"send_mail":false', self::getBody($container[2])); 
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_change_subscription_charge_day($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['subscriptionChangeChargeDay']);
        $response = $client->subscriptions()->changeChargeDay('SUBSCRIBER_CODE', 15);

        $this->assertEquals(
            Subscriptions::PATCH,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            '/payments/api/v1/subscriptions/SUBSCRIBER_CODE',
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            '',
            $response
        );

        $this->assertContains('"due_day":15', self::getBody($container[1]));
    }
}