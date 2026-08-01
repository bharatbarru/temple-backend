<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Clientele;

class ClienteleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_clientele()
    {
        $clientele = Clientele::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/clienteles', $clientele
        );

        $this->assertApiResponse($clientele);
    }

    /**
     * @test
     */
    public function test_read_clientele()
    {
        $clientele = Clientele::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/clienteles/'.$clientele->id
        );

        $this->assertApiResponse($clientele->toArray());
    }

    /**
     * @test
     */
    public function test_update_clientele()
    {
        $clientele = Clientele::factory()->create();
        $editedClientele = Clientele::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/clienteles/'.$clientele->id,
            $editedClientele
        );

        $this->assertApiResponse($editedClientele);
    }

    /**
     * @test
     */
    public function test_delete_clientele()
    {
        $clientele = Clientele::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/clienteles/'.$clientele->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/clienteles/'.$clientele->id
        );

        $this->response->assertStatus(404);
    }
}
