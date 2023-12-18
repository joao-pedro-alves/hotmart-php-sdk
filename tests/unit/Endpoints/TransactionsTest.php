<?php

namespace Hotmart\Test\Endpoints;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use Hotmart\Http\Endpoints\Transactions;
use Hotmart\Http\Routes;

class TransactionsTest extends BaseTestCase
{
    public function mockProvider()
    {
        return [[[
            'history' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('TransactionHistory')),
            ]),
            'summary' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('TransactionSummary')),
            ]),
            'participants' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('TransactionParticipants')),
            ]),
            'commissions' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('TransactionCommissions')),
            ]),
            'priceDetails' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], self::jsonMock('TransactionPriceDetails')),
            ]),
            'refund' => new MockHandler([
                new Response(200, [], self::jsonMock('Authentication')),
                new Response(200, [], ''),
            ]),
        ]]];
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_transactions_history($mock)
    {
        $container = [];

        $params = [
            'max_results' => 5,
            'page_token' => 'abc',
            'product_id' => '123',
            'start_date' => 1111111111,
            'end_date' => 1111111111,
            'sales_source' => 'source',
            'transaction' => 'ttttttt',
            'buyer_name' => 'JOAO',
            'buyer_email' => 'buyer@mail.com',
            'transaction_status' => 'APPROVED',
            'payment_type' => 'CREDIT_CARD',
            'offer_code' => 'myoffer',
            'commission_as' => 'AFFILIATE',
        ];
        $client = self::buildClient($container, $mock['history']);
        $response = $client->transactions()->history($params);

        $this->assertEquals(
            Transactions::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::transactions()->history(),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('TransactionHistory'), true),
            $response
        );

        $query = self::getQueryString($container[1]);

        foreach (explode('&', http_build_query($params)) as $param) {
            $this->assertContains($param, $query);
        }
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_transactions_summary($mock)
    {
        $container = [];

        $params = [
            'max_results' => 5,
            'page_token' => 'abc',
            'product_id' => '123',
            'start_date' => 1111111111,
            'end_date' => 1111111111,
            'sales_source' => 'source',
            'transaction' => 'ttttttt',
            'buyer_name' => 'JOAO',
            'buyer_email' => 'buyer@mail.com',
            'transaction_status' => 'APPROVED',
            'payment_type' => 'CREDIT_CARD',
            'offer_code' => 'myoffer',
            'commission_as' => 'AFFILIATE',
        ];
        $client = self::buildClient($container, $mock['summary']);
        $response = $client->transactions()->summary($params);

        $this->assertEquals(
            Transactions::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::transactions()->summary(),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('TransactionSummary'), true),
            $response
        );

        $query = self::getQueryString($container[1]);

        foreach (explode('&', http_build_query($params)) as $param) {
            $this->assertContains($param, $query);
        }
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_transactions_participants($mock)
    {
        $container = [];

        $params = [
            'max_results' => 5,
            'page_token' => 'abc',
            'product_id' => '123',
            'start_date' => 1111111111,
            'end_date' => 1111111111,
            'sales_source' => 'source',
            'transaction' => 'ttttttt',
            'buyer_name' => 'JOAO',
            'buyer_email' => 'buyer@mail.com',
            'affiliate_name' => 'PEDRO',
            'transaction_status' => 'APPROVED',
            'commission_as' => 'AFFILIATE',
        ];
        $client = self::buildClient($container, $mock['participants']);
        $response = $client->transactions()->participants($params);

        $this->assertEquals(
            Transactions::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::transactions()->participants(),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('TransactionParticipants'), true),
            $response
        );

        $query = self::getQueryString($container[1]);

        foreach (explode('&', http_build_query($params)) as $param) {
            $this->assertContains($param, $query);
        }
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_transactions_commissions($mock)
    {
        $container = [];

        $params = [
            'max_results' => 5,
            'page_token' => 'abc',
            'product_id' => '123',
            'start_date' => 1111111111,
            'end_date' => 1111111111,
            'transaction' => 'ttttttt',
            'commission_as' => 'AFFILIATE',
            'transaction_status' => 'APPROVED',
        ];
        $client = self::buildClient($container, $mock['commissions']);
        $response = $client->transactions()->commissions($params);

        $this->assertEquals(
            Transactions::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::transactions()->commissions(),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('TransactionCommissions'), true),
            $response
        );

        $query = self::getQueryString($container[1]);

        foreach (explode('&', http_build_query($params)) as $param) {
            $this->assertContains($param, $query);
        }
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_get_transactions_price_details($mock)
    {
        $container = [];

        $params = [
            'max_results' => 5,
            'page_token' => 'abc',
            'product_id' => '123',
            'start_date' => 1111111111,
            'end_date' => 1111111111,
            'transaction' => 'ttttttt',
            'transaction_status' => 'APPROVED',
            'payment_type' => 'CASH_PAYMENT',
        ];
        $client = self::buildClient($container, $mock['priceDetails']);
        $response = $client->transactions()->priceDetails($params);

        $this->assertEquals(
            Transactions::GET,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::transactions()->priceDetails(),
            self::getRequestUri($container[1])
        );

        $this->assertEquals(
            json_decode(self::jsonMock('TransactionPriceDetails'), true),
            $response
        );

        $query = self::getQueryString($container[1]);

        foreach (explode('&', http_build_query($params)) as $param) {
            $this->assertContains($param, $query);
        }
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_transaction_refund($mock)
    {
        $container = [];

        $client = self::buildClient($container, $mock['refund']);
        $response = $client->transactions()->refund('TRANSACTION_CODE');

        $this->assertEquals(
            Transactions::PUT,
            self::getRequestMethod($container[1])
        );

        $this->assertEquals(
            Routes::transactions()->refund('TRANSACTION_CODE'),
            self::getRequestUri($container[1])
        );

        $this->assertEquals('', $response);
    }
}