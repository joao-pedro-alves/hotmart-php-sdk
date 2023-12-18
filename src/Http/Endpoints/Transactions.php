<?php

namespace Hotmart\Http\Endpoints;

use Hotmart\Http\Routes;

class Transactions extends Endpoint
{
    /**
     * @param array $params
     * @return array
     */
    public function history(array $params = [])
    {
        return $this->http->request(
            self::GET,
            Routes::transactions()->history(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param array $params
     * @return array
     */
    public function summary(array $params = [])
    {
        return $this->http->request(
            self::GET,
            Routes::transactions()->summary(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param array $params
     * @return array
     */
    public function participants(array $params = [])
    {
        return $this->http->request(
            self::GET,
            Routes::transactions()->participants(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param array $params
     * @return array
     */
    public function commissions(array $params = [])
    {
        return $this->http->request(
            self::GET,
            Routes::transactions()->commissions(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param array $params
     * @return array
     */
    public function priceDetails(array $params = [])
    {
        return $this->http->request(
            self::GET,
            Routes::transactions()->priceDetails(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param string $transactionCode
     * @return array
     */
    public function refund(string $transactionCode)
    {
        return $this->http->request(
            self::PUT,
            Routes::transactions()->refund($transactionCode),
            $this->bindToken()
        );
    }
}