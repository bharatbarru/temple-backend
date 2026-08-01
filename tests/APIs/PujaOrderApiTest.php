<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PujaOrder;

class PujaOrderApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_puja_order()
    {
        $pujaOrder = PujaOrder::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/pujaOrders', $pujaOrder
        );

        $this->assertApiResponse($pujaOrder);
    }

    /**
     * @test
     */
    public function test_read_puja_order()
    {
        $pujaOrder = PujaOrder::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/pujaOrders/'.$pujaOrder->id
        );

        $this->assertApiResponse($pujaOrder->toArray());
    }

    /**
     * @test
     */
    public function test_update_puja_order()
    {
        $pujaOrder = PujaOrder::factory()->create();
        $editedPujaOrder = PujaOrder::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/pujaOrders/'.$pujaOrder->id,
            $editedPujaOrder
        );

        $this->assertApiResponse($editedPujaOrder);
    }

    /**
     * @test
     */
    public function test_delete_puja_order()
    {
        $pujaOrder = PujaOrder::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/pujaOrders/'.$pujaOrder->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/pujaOrders/'.$pujaOrder->id
        );

        $this->response->assertStatus(404);
    }
}
