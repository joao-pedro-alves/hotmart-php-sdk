<?php

namespace Hotmart\Http\Endpoints;

use Hotmart\Http\Routes;

class Subscriptions extends Endpoint
{
    /**
     * @param array $params
     * @return array
     */
    public function get($params = [])
    {
        if (!is_array($params)) {
            throw new \InvalidArgumentException("'params' should be an array");
        }

        return $this->http->request(
            self::GET,
            Routes::subscriptions()->base(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param array $params
     * @return array
     */
    public function summary($params = [])
    {
        if (!is_array($params)) {
            throw new \InvalidArgumentException("'params' should be an array");
        }

        return $this->http->request(
            self::GET,
            Routes::subscriptions()->summary(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param string $subscriberCode
     * @param array $params
     * @return array|null
     */
    public function purchases($subscriberCode, $params = [])
    {
        if (!is_array($params)) {
            throw new \InvalidArgumentException("'params' should be an array");
        }

        return $this->http->request(
            self::GET,
            Routes::subscriptions()->purchases($subscriberCode),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param string $subscriberCode
     * @param array $params
     * @return array|null
     */
    public function cancel($subscriberCode, $params = [])
    {
        if (!is_array($params)) {
            throw new \InvalidArgumentException("'params' should be an array");
        }

        return $this->http->request(
            self::POST,
            Routes::subscriptions()->cancel($subscriberCode),
            $this->bindJson(array_merge(['send_mail' => true], $params), $this->bindToken())
        );
    }

    /**
     * @param string $subscriberCode
     * @param array $params
     * @return array|null
     */
    public function reactivate($subscriberCode, $params = [])
    {
        if (!is_array($params)) {
            throw new \InvalidArgumentException("'params' should be an array");
        }

        return $this->http->request(
            self::POST,
            Routes::subscriptions()->reactivate($subscriberCode),
            $this->bindJson(array_merge(['charge' => false], $params), $this->bindToken())
        );
    }

    /**
     * @param array $subscriberCodeList
     * @param array $params
     * @return array|null
     */
    public function reactivateList($subscriberCodeList, $params = [])
    {
        if (!is_array($subscriberCodeList)) {
            throw new \InvalidArgumentException("'subscriberCodeList' should be an array");
        }

        if (!is_array($params)) {
            throw new \InvalidArgumentException("'params' should be an array");
        }

        $options = [
            'json' => array_merge([
                'subscriber_code' => $subscriberCodeList,
                'charge' => false,
            ], $params),
        ];

        return $this->http->request(
            self::POST,
            Routes::subscriptions()->reactivateList(),
            $this->bindToken($options)
        );
    }

    /**
     * @param array $subscriberCodeList
     * @param array $params
     * @return array|null
     */
    public function cancelList($subscriberCodeList, $params = [])
    {
        if (!is_array($subscriberCodeList)) {
            throw new \InvalidArgumentException("'subscriberCodeList' should be an array");
        }

        if (!is_array($params)) {
            throw new \InvalidArgumentException("'params' should be an array");
        }

        return $this->http->request(
            self::POST,
            Routes::subscriptions()->cancelList(),
            $this->bindJson(array_merge([
                'subscriber_code' => $subscriberCodeList,
                'send_mail' => true,
            ], $params), $this->bindToken())
        );
    }

    /**
     * @param string $subscriberCode
     * @param int $dueDay
     * @return string
     */
    public function changeChargeDay($subscriberCode, $dueDay)
    {
        return $this->http->request(
            self::PATCH,
            Routes::subscriptions()->changeChargeDay($subscriberCode),
            $this->bindJson($this->bindToken([
                'due_day' => $dueDay
            ]))
        );
    }
}