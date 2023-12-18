<?php
namespace Hotmart\Test\Endpoints;

use Hotmart\Http\Routes;

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
}