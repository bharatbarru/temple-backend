<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\HallEventType;

class HallEventTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hall_event_type()
    {
        $hallEventType = HallEventType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/hallEventTypes', $hallEventType
        );

        $this->assertApiResponse($hallEventType);
    }

    /**
     * @test
     */
    public function test_read_hall_event_type()
    {
        $hallEventType = HallEventType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/hallEventTypes/'.$hallEventType->id
        );

        $this->assertApiResponse($hallEventType->toArray());
    }

    /**
     * @test
     */
    public function test_update_hall_event_type()
    {
        $hallEventType = HallEventType::factory()->create();
        $editedHallEventType = HallEventType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/hallEventTypes/'.$hallEventType->id,
            $editedHallEventType
        );

        $this->assertApiResponse($editedHallEventType);
    }

    /**
     * @test
     */
    public function test_delete_hall_event_type()
    {
        $hallEventType = HallEventType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/hallEventTypes/'.$hallEventType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/hallEventTypes/'.$hallEventType->id
        );

        $this->response->assertStatus(404);
    }
}
