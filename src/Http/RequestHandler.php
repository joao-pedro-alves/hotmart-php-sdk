<?php

namespace Hotmart\Http;

class RequestHandler
{
    /**
     * @var array $params
     * @var array $options
     * @return array
     */
    public static function bindQueryParams($params, $options = [])
    {
        return array_merge($options, [
            'query' => $params,
        ]);
    }

    /**
     * @var array $headers
     * @var array $options
     * @return array
     */
    public static function putHeaders($headers, $options = [])
    {
        return array_merge($options, [
            'headers' => $headers,
        ]);
    }

    /**
     * @var array $params
     * @var array $options
     * @return array
     */
    public static function bindJson($params, $options = [])
    {
        return array_merge($options, [
            'json' => $params,
        ]);
    }
}