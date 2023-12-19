<?php
namespace Hotmart\Test\Http\Endpoints;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Hotmart\Http\ResponseHandler;
use Hotmart\Exceptions\HotmartException;
use GuzzleHttp\Exception\ClientException;
use Hotmart\Test\BaseTestCase;

class ResponseHandlerTest extends BaseTestCase
{
    public function mockProvider()
    {
        return [[[
            'unauthorized' => self::jsonMock('Unauthorized')
        ]]];
    }

    /**
     * @dataProvider mockProvider
     */
    public function test_failure($mock)
    {
        $request = new Request('GET', '/test');
        $respose = new Response(400, [], $mock['unauthorized']);
        $exception = new ClientException('MESSAGE', $request, $respose);

        $this->expectException(HotmartException::class);
        $this->expectExceptionMessage("Full authentication is required to access this resource.");

        ResponseHandler::failure($exception);
    }
}