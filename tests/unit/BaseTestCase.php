<?php

namespace Hotmart\Test;

use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    static protected function loadJsonMock(string $path)
    {
        $rawJson = file_get_contents(__DIR__ . "/Mocks/$path.json");
        return json_decode($rawJson, true);
    }
}


