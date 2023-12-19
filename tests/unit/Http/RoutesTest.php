<?php
namespace Hotmart\Test\Http;

use Hotmart\Http\Routes;
use Hotmart\Test\BaseTestCase;

class RoutesTest extends BaseTestCase
{
    public function test_subscription_routes()
    {
        $routes = Routes::subscriptions();

        $this->assertObjectHasAttribute('base', $routes);
        $this->assertIsCallable($routes->base);
        $this->assertEquals('/payments/api/v1/subscriptions', $routes->base());

        $this->assertObjectHasAttribute('summary', $routes);
        $this->assertIsCallable($routes->summary);
        $this->assertEquals('/payments/api/v1/subscriptions/summary', $routes->summary());

        $this->assertObjectHasAttribute('purchases', $routes);
        $this->assertIsCallable($routes->purchases);
        $this->assertEquals('/payments/api/v1/subscriptions/abc/purchases', $routes->purchases('abc'));

        $this->assertObjectHasAttribute('cancel', $routes);
        $this->assertIsCallable($routes->cancel);
        $this->assertEquals('/payments/api/v1/subscriptions/abc/cancel', $routes->cancel('abc'));

        $this->assertObjectHasAttribute('reactivate', $routes);
        $this->assertIsCallable($routes->reactivate);
        $this->assertEquals('/payments/api/v1/subscriptions/abc/reactivate', $routes->reactivate('abc'));

        $this->assertObjectHasAttribute('reactivateList', $routes);
        $this->assertIsCallable($routes->reactivateList);
        $this->assertEquals('/payments/api/v1/subscriptions/reactivate', $routes->reactivateList());

        $this->assertObjectHasAttribute('cancelList', $routes);
        $this->assertIsCallable($routes->cancelList);
        $this->assertEquals('/payments/api/v1/subscriptions/cancel', $routes->cancelList());
    }

    public function test_transaction_routes()
    {
        $routes = Routes::transactions();

        $this->assertObjectHasAttribute('history', $routes);
        $this->assertIsCallable($routes->history);
        $this->assertEquals('/payments/api/v1/sales/history', $routes->history());

        $this->assertObjectHasAttribute('summary', $routes);
        $this->assertIsCallable($routes->summary);
        $this->assertEquals('/payments/api/v1/sales/summary', $routes->summary());

        $this->assertObjectHasAttribute('participants', $routes);
        $this->assertIsCallable($routes->participants);
        $this->assertEquals('/payments/api/v1/sales/users', $routes->participants());

        $this->assertObjectHasAttribute('commissions', $routes);
        $this->assertIsCallable($routes->commissions);
        $this->assertEquals('/payments/api/v1/sales/commissions', $routes->commissions());

        $this->assertObjectHasAttribute('priceDetails', $routes);
        $this->assertIsCallable($routes->priceDetails);
        $this->assertEquals('/payments/api/v1/sales/price/details', $routes->priceDetails());

        $this->assertObjectHasAttribute('refund', $routes);
        $this->assertIsCallable($routes->refund);
        $this->assertEquals('/payments/api/v1/sales/abc/refund', $routes->refund('abc'));  
    }

    public function test_club_routes()
    {
        $routes = Routes::club();

        $this->assertObjectHasAttribute('modules', $routes);
        $this->assertIsCallable($routes->modules);
        $this->assertEquals('/club/api/v1/modules', $routes->modules());

        $this->assertObjectHasAttribute('modulePages', $routes);
        $this->assertIsCallable($routes->modulePages);
        $this->assertEquals('/club/api/v1/modules/MODULE_ID/pages', $routes->modulePages('MODULE_ID'));

        $this->assertObjectHasAttribute('users', $routes);
        $this->assertIsCallable($routes->users);
        $this->assertEquals('/club/api/v1/users', $routes->users());

        $this->assertObjectHasAttribute('userLessons', $routes);
        $this->assertIsCallable($routes->users);
        $this->assertEquals('/club/api/v1/users/USER_ID/lessons', $routes->userLessons('USER_ID'));
    }
}