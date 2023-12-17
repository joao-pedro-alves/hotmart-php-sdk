<?php

namespace Hotmart\Exceptions;

class HotmartException extends \Exception
{
    /**
     * @var array|string
     */
    private $data;

    /**
     * @param string $type
     * @param array|string $data
     * @param string $message
     */
    public function __construct($data, $message = '')
    {
        $this->data = $data;

        if (empty($message)) {
            $message = 'Unknown error';
        }

        parent::__construct($message);
    }

    /**
     * @return array|string
     */
    public function getData()
    {
        return $this->data;
    }
}