<?php

namespace Hotmart\Http;

use Hotmart\Exceptions\HotmartException;
use GuzzleHttp\Exception\ServerException;
use Hotmart\Exceptions\InvalidJsonException;

class ResponseHandler
{
    /**
     * @param \GuzzleHttp\Exception\ClientException|\GuzzleHttp\Exception\ServerException $e
     * @param string $type
     * @return \Hotmart\Exceptions\HotmartException
     */
    public static function failure($exception)
    {
        $body = (string)$exception->getResponse()->getBody();

        try {
            $jsonError = self::toJson($body);
        } catch (InvalidJsonException $invalidJson) {
            if ($exception instanceof ServerException) {
                throw $exception;
            }
            $jsonError = null;
        }

        throw new HotmartException($jsonError, ($jsonError && isset($jsonError['error_description'])) ? $jsonError['error_description'] : '');
    }

    /**
     * @param string $json
     * @return \ArrayObject
     */
    private static function toJson($json)
    {
        $result = json_decode($json, true);

        if (json_last_error() != \JSON_ERROR_NONE) {
            throw new InvalidJsonException(json_last_error_msg());
        }

        return $result;
    }
}