<?php


use Buuyers\BuuyersClient;
use GuzzleHttp\Middleware;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class BuuyersClientTest extends TestCase
{

    public function testBasicClient()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], "{\"foo\":\"bar\"}")
        ]);

        $container = [];
        $history = Middleware::history($container);
        $stack = HandlerStack::create($mock);
        $stack->push($history);

        $http_client = new Client(['handler' => $stack]);

        $client = new BuuyersClient('u', 'p');
        $client->setClient($http_client);

        $client->companies->getCompany(1);

        foreach ($container as $transaction) {
            $basic = $transaction['request']->getHeaders()['Authorization'][0];
            $this->assertTrue($basic == "Basic dTpw");
            $method = $transaction['request']->getMethod();
            $this->assertEquals($method, 'GET');
            //> GET
            if ($transaction['response']) {
                $statusCode = $transaction['response']->getStatusCode();
                $this->assertEquals(200, $statusCode);
                //> 200, 200
            } elseif ($transaction['error']) {
                echo $transaction['error'];
                //> exception
            }
        }
    }


}