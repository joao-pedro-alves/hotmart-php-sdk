<?php

namespace Hotmart\Http\Endpoints;

use Hotmart\Http\Routes;

class Club extends Endpoint
{
    /**
     * @param string $subdomain
     * @param array $params
     * @return array
     */
    public function modules(string $subdomain, array $params = [])
    {
        $params = array_merge(['subdomain' => $subdomain], $params);

        return $this->http->request(
            self::GET,
            Routes::club()->modules(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param string $subdomain
     * @param string $moduleId
     * @param array $params
     * @return array
     */
    public function modulePages(string $subdomain, string $moduleId)
    {
        $params = [
            'subdomain' => $subdomain,
            'module_id' => $moduleId
        ];

        return $this->http->request(
            self::GET,
            Routes::club()->modulePages($moduleId),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param string $subdomain
     * @param array $params
     * @return array
     */
    public function users(string $subdomain)
    {
        $params = [
            'subdomain' => $subdomain,
        ];

        return $this->http->request(
            self::GET,
            Routes::club()->users(),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }

    /**
     * @param string $subdomain
     * @param array $params
     * @param string $userId
     * @return array
     */
    public function userLessons(string $subdomain, string $userId)
    {
        $params = [
            'subdomain' => $subdomain,
        ];

        return $this->http->request(
            self::GET,
            Routes::club()->userLessons($userId),
            $this->bindQueryParams($params, $this->bindToken())
        );
    }
}