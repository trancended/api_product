<?php
declare(strict_types=1);

namespace Trancended\ApiProduct\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Trancended\ApiProduct\Dictionaries\Http;

class RouteTest extends TestCase
{

    public function dp_method_status()
    {
        return [
            ['GET', Http::HTTP_OK],
            ['HEAD', Http::HTTP_OK],
            ['POST', Http::HTTP_UNPROCESSABLE_ENTITY],
            //    ['POST', Http::HTTP_CREATED, ['name' => 'test', 'amount' => 1]],
            ['PUT', Http::HTTP_METHOD_NOT_ALLOWED],
            ['PATCH', Http::HTTP_METHOD_NOT_ALLOWED],
            ['DELETE', Http::HTTP_METHOD_NOT_ALLOWED],
        ];
    }

    /**
     *
     * @dataProvider dp_method_status
     */
    public function testProductsIndexStatus($method, $status, $parameters = [])
    {
        $response = $this->call($method, '/api/v1/products', $parameters);
        $this->assertEquals($status, $response->status());
    }

    public function testProductsIndex()
    {
        $response = $this->call('GET', '/api/v1/products');
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);
        $data = $decodedResponse['data'];

        $this->assertNotEmpty($data);
    }

    public function testProductsStore()
    {
        $response = $this->call('POST', '/api/v1/products', ['name' => 'test', 'amount' => 7]);
        $content = $response->getContent();
        $decodedResponse = json_decode($content, true);
        $this->assertEquals($decodedResponse['data']['name'], 'Test');
        $this->assertEquals($decodedResponse['data']['amount'], 7);
    }

}
