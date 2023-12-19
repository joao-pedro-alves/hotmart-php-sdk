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

    /**
     * @return \Hotmart\Anonymous
     */
    public static function transactions()
    {
        $std = new Anonymous();

        $std->history = static function () {
            return '/payments/api/v1/sales/history';
        };

        $std->summary = static function () {
            return '/payments/api/v1/sales/summary';
        };

        $std->participants = static function () {
            return '/payments/api/v1/sales/users';
        };

        $std->commissions = static function () {
            return '/payments/api/v1/sales/commissions';
        };

        $std->priceDetails = static function () {
            return '/payments/api/v1/sales/price/details';
        };

        $std->refund = static function ($transactionCode) {
            return '/payments/api/v1/sales/'.$transactionCode.'/refund';
        };

        return $std;
    }

    /**
     * @return \Hotmart\Anonymous
     */
    public static function club()
    {
        $std = new Anonymous();

        $std->modules = static function () {
            return '/club/api/v1/modules';
        };

        $std->modulePages = static function ($moduleId) {
            return '/club/api/v1/modules/'.$moduleId.'/pages';
        };

        $std->users = static function () {
            return '/club/api/v1/users';
        };

        $std->userLessons = static function ($userId) {
            return '/club/api/v1/users/' . $userId . '/lessons';
        };

        return $std;
    }
}