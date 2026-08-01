<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Puja;

class PujaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_puja()
    {
        $puja = Puja::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pujas', $puja
        );

        $this->assertApiResponse($puja);
    }

    /**
     * @test
     */
    public function test_read_puja()
    {
        $puja = Puja::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/pujas/'.$puja->id
        );

        $this->assertApiResponse($puja->toArray());
    }

    /**
     * @test
     */
    public function test_update_puja()
    {
        $puja = Puja::factory()->create();
        $editedPuja = Puja::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pujas/'.$puja->id,
            $editedPuja
        );

        $this->assertApiResponse($editedPuja);
    }

    /**
     * @test
     */
    public function test_delete_puja()
    {
        $puja = Puja::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pujas/'.$puja->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pujas/'.$puja->id
        );

        $this->response->assertStatus(404);
    }
}
