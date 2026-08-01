<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\HallOrder;

class HallOrderApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hall_order()
    {
        $hallOrder = HallOrder::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/hallOrders', $hallOrder
        );

        $this->assertApiResponse($hallOrder);
    }

    /**
     * @test
     */
    public function test_read_hall_order()
    {
        $hallOrder = HallOrder::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/hallOrders/'.$hallOrder->id
        );

        $this->assertApiResponse($hallOrder->toArray());
    }

    /**
     * @test
     */
    public function test_update_hall_order()
    {
        $hallOrder = HallOrder::factory()->create();
        $editedHallOrder = HallOrder::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/hallOrders/'.$hallOrder->id,
            $editedHallOrder
        );

        $this->assertApiResponse($editedHallOrder);
    }

    /**
     * @test
     */
    public function test_delete_hall_order()
    {
        $hallOrder = HallOrder::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/hallOrders/'.$hallOrder->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/hallOrders/'.$hallOrder->id
        );

        $this->response->assertStatus(404);
    }
}
