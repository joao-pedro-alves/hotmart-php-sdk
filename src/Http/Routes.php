<?php

namespace Hotmart\Http;

use Hotmart\Anonymous;

class Routes
{
    /**
     * @return \Hotmart\Anonymous
     */
    public static function authentication()
    {
        $std = new Anonymous();

        $std->token = static function () {
            return 'https://api-sec-vlc.hotmart.com/security/oauth/token';
        };

        return $std;
    }

    /**
     * @return \Hotmart\Anonymous
     */
    public static function subscriptions()
    {
        $std = new Anonymous();

        $std->base = static function () {
            return '/payments/api/v1/subscriptions';
        };

        $std->summary = static function () {
            return '/payments/api/v1/subscriptions/summary';
        };

        $std->purchases = static function ($subscriberCode) {
            return '/payments/api/v1/subscriptions/' . $subscriberCode . '/purchases';
        };

        $std->cancel = static function ($subscriberCode) {
            return '/payments/api/v1/subscriptions/' . $subscriberCode . '/cancel';
        };

        $std->reactivate = static function ($subscriberCode) {
            return '/payments/api/v1/subscriptions/' . $subscriberCode . '/reactivate';
        };

        $std->reactivateList = static function () {
            return '/payments/api/v1/subscriptions/reactivate';
        };

        $std->cancelList = static function () {
            return '/payments/api/v1/subscriptions/cancel';
        };

        $std->changeChargeDay = static function ($subscriberCode) {
            return '/payments/api/v1/subscriptions/' . $subscriberCode;
        };

        return $std;
    }
}