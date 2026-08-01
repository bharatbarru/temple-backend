<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Hall;

class HallApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hall()
    {
        $hall = Hall::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/halls', $hall
        );

        $this->assertApiResponse($hall);
    }

    /**
     * @test
     */
    public function test_read_hall()
    {
        $hall = Hall::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/halls/'.$hall->id
        );

        $this->assertApiResponse($hall->toArray());
    }

    /**
     * @test
     */
    public function test_update_hall()
    {
        $hall = Hall::factory()->create();
        $editedHall = Hall::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/halls/'.$hall->id,
            $editedHall
        );

        $this->assertApiResponse($editedHall);
    }

    /**
     * @test
     */
    public function test_delete_hall()
    {
        $hall = Hall::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/halls/'.$hall->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/halls/'.$hall->id
        );

        $this->response->assertStatus(404);
    }
}
