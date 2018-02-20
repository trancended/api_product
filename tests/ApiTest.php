<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Tests;

use Trancended\ApiProduct\Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Trancended\ApiProduct\Dictionaries\Http;
use Trancended\ApiProduct\Repositories\Entities\Product;

class ApiTest extends TestCase
{

    public function getMethodStatus()
    {
        return [
            ['GET', Http::HTTP_OK],
            ['HEAD', Http::HTTP_OK],
            ['POST', Http::HTTP_UNPROCESSABLE_ENTITY],
            ['POST', Http::HTTP_CREATED, ['name' => 'test', 'amount' => 1]],
            ['PUT', Http::HTTP_METHOD_NOT_ALLOWED],
            ['PATCH', Http::HTTP_METHOD_NOT_ALLOWED],
            ['DELETE', Http::HTTP_METHOD_NOT_ALLOWED],
        ];
    }

    /**
     *
     * @param string $method
     * @param int $status
     * @param array $parameters
     * @dataProvider getMethodStatus
     */
    public function testProductsIndexStatus($method, $status, $parameters = [])
    {
        $response = $this->call($method, '/api/v1/products', $parameters);
        $this->assertEquals($status, $response->status());
    }

    public function testProductStore()
    {
        $response = $this->call('POST', '/api/v1/products', ['name' => 'testProductsStore', 'amount' => 1]);
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);
        $this->assertEquals($decodedResponse['data']['name'], 'testProductsStore');
        $this->assertEquals($decodedResponse['data']['amount'], 1);

        $this->assertEquals(Http::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }

    public function testProductStoreBadRequest()
    {
        $response = $this->call('POST', '/api/v1/products', ['name' => 'testProductStoreBadRequest']);
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);

        $this->assertEquals($decodedResponse['error'], '{"amount":["The amount field is required."]}');
        $this->assertEquals($decodedResponse['code'], Http::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals(Http::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }

    public function testProductShow()
    {
        $this->call('POST', '/api/v1/products', ['name' => 'testProductShow', 'amount' => 2]);

        $response = $this->call('GET', '/api/v1/products/1');
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);

        $this->assertEquals($decodedResponse['data']['name'], 'testProductShow');
        $this->assertEquals($decodedResponse['data']['amount'], 2);

        $this->assertEquals(Http::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }

    public function testProductShowNotFound()
    {
        $response = $this->call('GET', '/api/v1/products/100');
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);

        $this->assertEquals($decodedResponse['error'], Http::getMessage(Http::HTTP_NOT_FOUND));
        $this->assertEquals($decodedResponse['code'], Http::HTTP_NOT_FOUND);

        $this->assertEquals(Http::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }

    public function testProductsIndex()
    {
        $this->call('POST', '/api/v1/products', ['name' => 'testProductsIndex', 'amount' => 3]);

        $response = $this->call('GET', '/api/v1/products');
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);
        $data = $decodedResponse['data'];

        $this->assertNotEmpty($data);

        $this->assertEquals($decodedResponse['data'][0]['name'], 'testProductsIndex');
        $this->assertEquals($decodedResponse['data'][0]['amount'], 3);

        $this->assertEquals(Http::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }

    public function testProductUpdate()
    {
        $this->call('POST', '/api/v1/products', ['name' => 'testProductUpdate1', 'amount' => 4]);

        $response = $this->call('PUT', '/api/v1/products/1', ['name' => 'testProductUpdate2', 'amount' => 5]);
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);

        $this->assertEquals($decodedResponse['data']['name'], 'testProductUpdate2');
        $this->assertEquals($decodedResponse['data']['amount'], 5);

        $this->assertEquals(Http::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }

    public function testProductUpdateWithoutChange()
    {
        $this->call('POST', '/api/v1/products', ['name' => 'testProductUpdate1', 'amount' => 4]);

        $response = $this->call('PUT', '/api/v1/products/1', ['name' => 'testProductUpdate1', 'amount' => 4]);
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);

        $this->assertEquals($decodedResponse['error'], 'You need to specify any different value to update');
        $this->assertEquals($decodedResponse['code'], Http::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals(Http::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }

    public function testProductDelete()
    {
        $this->call('POST', '/api/v1/products', ['name' => 'testProductDelete', 'amount' => 6]);

        $response = $this->call('DELETE', '/api/v1/products/1');
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);

        $this->assertEquals($decodedResponse['data']['name'], 'testProductDelete');
        $this->assertEquals($decodedResponse['data']['amount'], 6);

        $this->assertEquals(Http::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }

    public function testProductDeleteNotFound()
    {
        $response = $this->call('DELETE', '/api/v1/products/1');
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);

        $this->assertEquals($decodedResponse['error'], Http::getMessage(Http::HTTP_NOT_FOUND));
        $this->assertEquals($decodedResponse['code'], Http::HTTP_NOT_FOUND);

        $this->assertEquals(Http::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }
}
